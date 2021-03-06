<?php

$errMsg ="";

try{
    header("Content-type: text/html; charset=utf-8");

    require_once('connectMeetain.php');

    $forum_post_no = $_POST['forum_post_no'];

    // $sql="SELECT forum_post_no, mem_no, forum_post_poster, forum_post_category, forum_post_image, forum_post_time, forum_post_title, forum_post_innertext, mem_id, mem_avator
	  //   from forum_post
    //         join member on(mem_no = forum_post_poster)
    //         where forum_post_no = '$forum_post_no' and forum_post_situation = 1 and forum_post_category not in ('公告')
    //         group by forum_post_no;";

    $sql="SELECT  f.forum_post_no , f.forum_post_poster, m.mem_avator, m.mem_id ,r.mem_realname , g.guide_no ,m.mem_badge1 , a1.achievement_image 'badge1' , m.mem_badge2 , a2.achievement_image 'badge2' , m.mem_badge3 , a3.achievement_image 'badge3', f.forum_post_image , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT( distinct c.comment_innertext) 'NUMreply' , max(c.comment_time) 'replytime' , COUNT( distinct fk.forum_keep_mem) 'NUMkeep'
    FROM forum_post f
            LEFT OUTER JOIN member_realname r ON ( f.forum_post_poster = r.mem_no and r.mem_realname_situation = '已審核已通過')
            LEFT OUTER JOIN member_guide g ON ( f.forum_post_poster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON f.forum_post_poster = m.mem_no
            LEFT OUTER JOIN comment_post c ON (f.forum_post_no = c.forum_post_no  and c.comment_situation = 1)
            LEFT OUTER JOIN forum_keep fk on fk .forum_iskept_post = f.forum_post_no
            LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
            LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
            LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
    WHERE f.forum_post_no = '$forum_post_no' and f.forum_post_situation = 1 and forum_post_category not in ('公告')
    GROUP BY f.forum_post_no,f.forum_post_poster,c.forum_post_no,r.mem_realname , g.guide_no 
    ORDER BY f.forum_post_time DESC , f.forum_post_no";

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo (json_encode($result));

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>