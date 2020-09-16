<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('../connectMeetain.php');

    $tour_no = $_POST['tour_no'];
    $sql = "SELECT m.mem_no, m.mem_id, m.mem_avator
    FROM member m JOIN tour_participate tp ON m.mem_no = tp.tour_participate_mem
    WHERE tp.tour_participate_situation = '已審核不通過' AND tp.tour_participate_tour = $tour_no";


    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>