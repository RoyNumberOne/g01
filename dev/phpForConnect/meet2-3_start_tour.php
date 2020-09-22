<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    $tour_no = $_REQUEST['tour_no'];

    $sql = "UPDATE tour 
	    set tour_progress = '已截止'
        where tour_no = $tour_no;";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>