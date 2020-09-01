<?php
$errMsg = "";

// $admin_no = $_REQUEST["admin_no"];
// $admin_name = $_REQUEST["EDITadmin_name"];
// $admin_mail = $_REQUEST["EDITadmin_id"];
// $admin_id = $_REQUEST["EDITadmin_mail"];

try{
  require_once("./connectMeetain.php");
  $sql = "update administrator set  admin_id=:admin_id,
                                    admin_name=:admin_name,
                                    admin_mail=:admin_mail,
                                    admin_authority=:admin_authority
                                    where admin_no=:admin_no";
    $products=$pdo->prepare($sql);
    $products->bindValue(":admin_id",$_REQUEST["EDITadmin_id"]);
    $products->bindValue(":admin_name",$_REQUEST["EDITadmin_name"]);
    $products->bindValue(":admin_mail",$_REQUEST["EDITadmin_mail"]);
    $products->bindValue(":admin_authority",$_REQUEST["EDITadmin_authority"]);
    $products->bindValue(":admin_no",$_REQUEST["admin_no"]);
    $products->execute();
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}