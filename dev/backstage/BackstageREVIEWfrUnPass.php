<?php
$errMsg = "";


try{
  require_once("./connectMeetain.php");
  $sql = "update forum_report set   forum_report_situation=:forum_report_situation
                                    where forum_report_no=:forum_report_no";
    $products=$pdo->prepare($sql);
    $products->bindValue(":forum_report_situation",$_REQUEST["REVIEWfrIfPass"]);
    $products->bindValue(":forum_report_no",$_REQUEST["forum_report_no"]);
    $products->execute();
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>
