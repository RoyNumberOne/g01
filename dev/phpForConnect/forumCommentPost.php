<?php
    $errMsg = '';
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    $forum_post_no = $_POST['forum_post_no'];

    $sql = "SELECT cp.comment_no, cp.comment_poster, cp.comment_class, cp.forum_post_no, cp.comment_time, cp.comment_innertext, cp.comment_situation,
	m.mem_no, m.mem_id, m.mem_avator, m.mem_bg, m.mem_badge1, m.mem_badge1 , a1.achievement_image 'badge1'
    , m.mem_badge2 , a2.achievement_image 'badge2' , m.mem_badge3 , a3.achievement_image 'badge3' ,
    mg.guide_no , mr.mem_realname
    FROM comment_post cp
        LEFT OUTER JOIN member m ON cp.comment_poster = m.mem_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
        LEFT OUTER JOIN member_guide mg ON (m.mem_no = mg.mem_no AND mg.mem_guide_situation = '已審核已通過')
        LEFT OUTER JOIN member_realname mr ON (m.mem_no = mr.mem_no and mr.mem_realname_situation = '已審核已通過')
    WHERE cp.comment_class='討論區' AND cp.forum_post_no = '$forum_post_no' AND cp.comment_situation = 1";

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>