<?php
$errMsg = "";

session_start();
$mem_no = $_SESSION['mem_no'];
$badgespace = 'mem_badge'.$_REQUEST["badgespace"];
$newbadge = $_REQUEST["newbadge"];

try{
  require_once("./connectMeetain.php");
  $sql = "UPDATE member set $badgespace = $newbadge where mem_no = $mem_no;";
    $products=$pdo->prepare($sql);
    $products->execute();

  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}