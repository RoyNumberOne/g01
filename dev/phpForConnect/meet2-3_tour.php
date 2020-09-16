<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('../connectMeetain.php');
    // $sql = "SELECT * FROM tour WHERE tour_no = 100001";
    // $sql = "SELECT m.*, t.* FROM member m join tour t on m.mem_no = t.tour_hoster WHERE tour_no = 100001";
    $sql = "SELECT m.*, t.*, mt.mountain_name, mt.mountain_area, mt.mountain_image, DATEDIFF(tour_activityend , tour_activitystart)+1 'days' FROM member m join tour t on m.mem_no = t.tour_hoster join mountain mt on t.tour_mountain = mt.mountain_no WHERE tour_no = 100001";

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>