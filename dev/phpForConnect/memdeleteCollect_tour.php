<?php
$errMsg = "";
try{
    require_once('./connectMeetain.php');
    
     //抓取會員資訊
     session_start();
     $mem_no = $_SESSION["mem_no"]; // 變數（會員號碼） ＝ session 抓會員號碼

     $tourList_tour_no = isset($_GET["tourList_tour_no"]) ? $_GET["tourList_tour_no"] : 1;

    // $tour_no = $_GET["tour_no"];
    // $tour_no = '100012';  //mem_no = 10018

    $sql= " DELETE from tour_keep 
                where tour_keep_mem = '$mem_no' and tour_iskept_tour = '$tourList_tour_no';
     ";

    $pdoStatement = $pdo->query($sql); //執行mySQL指令
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
    
    

}catch(PDOException $e){ // p83.
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>