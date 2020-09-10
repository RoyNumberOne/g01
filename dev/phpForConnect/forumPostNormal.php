<?php
// -- 討論區首頁貼文 -- 非公告 -- 最新
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('connectMeetain.php');

    $sql= "SELECT  f.forum_post_no , f.forum_post_poster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT(*) 
    FROM forum_post f
      LEFT OUTER JOIN member_realname r ON ( f.forum_post_poster = r.mem_no and r.mem_realname_situation = '已審核已通過')
      LEFT OUTER JOIN member_guide g ON ( f.forum_post_poster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON f.forum_post_poster = m.mem_no
            JOIN comment_post c ON f.forum_post_no = c.forum_post_no
    WHERE f.forum_post_situation = 1 and forum_post_category not in ('公告')
    GROUP BY f.forum_post_poster,c.forum_post_no,r.mem_realname , g.guide_no
    ORDER BY f.forum_post_time DESC , f.forum_post_no DESC";
    
    // $sql= "SELECT  f.forum_post_no , f.forum_post_poster , m.mem_id , m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT(*) 
    //         FROM forum_post f JOIN member m ON f.forum_post_poster = m.mem_no JOIN comment_post c ON f.forum_post_no = c.forum_post_no
    //         WHERE f.forum_post_situation = 1 and f.forum_post_category not in ('公告')
    //         GROUP BY f.forum_post_no
    //         ORDER BY COUNT(*) DESC , f.forum_post_time DESC;";

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>