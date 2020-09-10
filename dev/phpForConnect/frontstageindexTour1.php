<?php
try{
    header("Content-type: text/html; charset=utf-8");

    require_once('connectMeetain.php');

    $sql="SELECT  t.tour_no , t.tour_hoster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , mt.mountain_area , t.tour_mountain , mt.mountain_name , mt.mountain_image ,  t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*) 
    FROM tour t
        LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
        LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON t.tour_hoster = m.mem_no
            JOIN comment_post c ON t.tour_no = c.tour_post_no
            JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
    WHERE t.tour_situation = 1 and tour_progress = '報名中'
    GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no
    ORDER BY t.tour_build DESC , t.tour_no DESC LIMIT 1 ;";

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>