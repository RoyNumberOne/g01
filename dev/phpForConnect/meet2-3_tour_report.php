<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $tour_report_mem = $_SESSION['mem_no']; //誰檢舉
    $tour_report_tour = $_REQUEST['tour_report_tour'];  //檢舉哪一團
    $tour_report_reason = $_REQUEST['tour_report_reason']; //檢舉緣由

    $sql = "INSERT  INTO tour_report (tour_report_mem, tour_report_tour, tour_report_reason, tour_report_situation)
            VALUES ('$tour_report_mem', '$tour_report_tour', '$tour_report_reason', '未處理' );";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>