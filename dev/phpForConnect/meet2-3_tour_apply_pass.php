<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    $tour_participate_mem = $_REQUEST['tour_participate_mem'];
    $tour_participate_tour = $_REQUEST['tour_participate_tour'];

    $sql = "UPDATE tour_participate set  tour_participate_situation = '已審核已通過'
            where  tour_participate_mem = $tour_participate_mem and tour_participate_tour = $tour_participate_tour;";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

    $sql = "UPDATE member set total_join = `total_join`+1 where mem_no = $tour_participate_mem ;";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>