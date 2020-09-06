<?php
$errMsg = "";


try{
  require_once("./connectMeetain.php");
  $sql = "update tour_report set    tour_report_situation=:tour_report_situation
                                    where tour_report_no=:tour_report_no";
    $products=$pdo->prepare($sql);
    $products->bindValue(":tour_report_situation",$_REQUEST["REVIEWtrIfPass"]);
    $products->bindValue(":tour_report_no",$_REQUEST["tour_report_no"]);
    $products->execute();
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>
