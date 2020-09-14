<?php
try{
    header("Content-type: text/html; charset=utf-8");

    require_once('connectMeetain.php');

    $sql="SELECT cp.forum_post_no, cp.comment_poster, cp.comment_innertext, cp.comment_time,m.mem_no, m.mem_id, m.mem_avator, m.mem_badge1, m.mem_badge2, m.mem_badge3, mr.mem_realname_situation, mg.mem_guide_situation
	FROM comment_post cp
		join member m on(m.mem_no = cp.comment_poster)
        join forum_post fp on (fp.forum_post_no = cp.forum_post_no)
        left join member_realname mr on(mr.mem_no = m.mem_no and mr.mem_realname_situation = '已審核已通過')
        left join member_guide mg on(mg.mem_no = m.mem_no and mg.mem_guide_situation = '已審核已通過')
        
	where fp.forum_post_no
    group by m.mem_no
    order by cp.comment_time limit 3;"; //彈性調整

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>