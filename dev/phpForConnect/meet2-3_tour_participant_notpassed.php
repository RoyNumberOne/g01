<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('../connectMeetain.php');
    $sql = "SELECT tp.tour_participate_tour, m.mem_no, m.mem_id, tp.tour_participate_situation, m.mem_avator, m.mem_badge1, m.mem_badge2, m.mem_badge3 FROM member m JOIN tour_participate tp ON m.mem_no = tp.tour_participate_mem WHERE tp.tour_participate_situation = '已審核不通過' ORDER BY tp.tour_participate_tour";


    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>