<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $tour_report_mem = $_SESSION['mem_no']; //誰檢舉
    $tour_post_no = $_REQUEST['tour_post_no'];
    
    $sql = "SELECT t.tour_no , tr.tour_report_mem from tour_report tr right outer join tour t on ( tr.tour_report_tour = t.tour_no and tr.tour_report_mem = $tour_report_mem) where t.tour_no = $tour_post_no;";
    

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>