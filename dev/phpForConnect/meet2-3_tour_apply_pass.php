<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    // session_start();
    $tour_participate_mem = $_REQUEST['tour_participate_mem'];
    $tour_participate_tour = $_REQUEST['tour_participate_tour'];
    // $tour_participate_situation = $_REQUEST['tour_participate_situation'];

    echo $tour_participate_mem;
    echo $tour_participate_tour;

    $sql = "UPDATE tour_participate set  tour_participate_situation = '已審核已通過'
            where  tour_participate_mem = $tour_participate_mem and tour_participate_tour = $tour_participate_tour;";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>