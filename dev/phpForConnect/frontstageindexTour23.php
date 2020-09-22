<?php
$errMsg='';
try{
    header("Content-type: text/html; charset=utf-8");

    require_once('connectMeetain.php');

    $sql="SELECT  t.tour_no , t.tour_hoster, m.mem_id, m.mem_avator ,r.mem_realname , g.guide_no , m.mem_badge1 , a1.achievement_image 'badge1' , m.mem_badge2 , a2.achievement_image 'badge2' , m.mem_badge3 , a3.achievement_image 'badge3' , mt.mountain_area , t.tour_mountain , mt.mountain_name , mt.mountain_image , mt.degree_category ,  t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*) 
    FROM tour t
        LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
        LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON t.tour_hoster = m.mem_no
            JOIN comment_post c ON t.tour_no = c.tour_post_no
            JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
    WHERE t.tour_situation = 1 and tour_progress = '報名中'
    GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no
    ORDER BY COUNT(*) DESC , t.tour_build DESC , t.tour_no DESC LIMIT 1,2 ;";

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>