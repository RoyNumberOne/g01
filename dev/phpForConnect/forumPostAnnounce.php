<?php
// 討論區首頁貼文 -- 公告 -- 最新3篇
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('connectMeetain.php');

    $sql= "	SELECT  f.forum_post_no , f.forum_post_poster, f.forum_post_title ,f.forum_post_image,m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , m.mem_avator, a1.achievement_image , m.mem_badge2 , a2.achievement_image , m.mem_badge3 , a3.achievement_image , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT(*) 
        FROM forum_post f
        LEFT OUTER JOIN member_realname r ON ( f.forum_post_poster = r.mem_no and r.mem_realname_situation = '已審核已通過')
        LEFT OUTER JOIN member_guide g ON ( f.forum_post_poster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON f.forum_post_poster = m.mem_no
            LEFT outer JOIN comment_post c ON f.forum_post_no = c.forum_post_no
            LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
            LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
            LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
        where f.forum_post_situation = 1 and forum_post_category = '公告'
        GROUP BY f.forum_post_poster,c.forum_post_no,r.mem_realname , g.guide_no ,forum_post_no
        ORDER BY f.forum_post_time DESC , f.forum_post_no DESC LIMIT 3;";

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>