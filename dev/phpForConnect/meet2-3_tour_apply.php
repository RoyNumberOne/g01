<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $tour_participate_mem = $_SESSION['mem_no'];
    $tour_participate_tour = $_REQUEST['tour_participate_tour'];
    // $tour_participate_situation = $_REQUEST['tour_participate_situation'];

    $sql = "INSERT  INTO tour_participate (tour_participate_mem, tour_participate_tour, tour_participate_situation)
            VALUES ('$tour_participate_mem', '$tour_participate_tour', '未審核');";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

    $sql = "UPDATE member set mem_point_tourjoin = `mem_point_tourjoin`+3000 , mem_point = `mem_point`+3000 where mem_no = $tour_participate_mem ;";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>