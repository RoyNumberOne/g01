<?php
$errMsg = "";


try{
  require_once("./connectMeetain.php");
  $sql = "update comment_report set     comment_report_situation=:comment_report_situation
                                        where comment_report_no=:comment_report_no";
    $products=$pdo->prepare($sql);
    $products->bindValue(":comment_report_situation",$_REQUEST["REVIEWcrIfPass"]);
    $products->bindValue(":comment_report_no",$_REQUEST["comment_report_no"]);
    $products->execute();
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>
