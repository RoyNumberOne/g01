<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    $tour_no = $_POST['tour_no'];
    $sql = "SELECT m.*, t.*, r.mem_realname, g.guide_no, mt.degree_category, mt.mountain_name, mt.mountain_area, mt.mountain_image, DATEDIFF(tour_activityend , tour_activitystart)+1 'days', t.tour_progress, a1.achievement_image 'badge1', a2.achievement_image 'badge2', a3.achievement_image 'badge3' 
    FROM member m join tour t on m.mem_no = t.tour_hoster join mountain mt on t.tour_mountain = mt.mountain_no
        LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過') 
        LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過') 
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
        WHERE tour_no = $tour_no and tour_situation = 1 ;";

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>