<?php
$errMsg = "";

// $admin_no = $_REQUEST["admin_no"];
// $admin_name = $_REQUEST["EDITadmin_name"];
// $admin_mail = $_REQUEST["EDITadmin_id"];
// $admin_id = $_REQUEST["EDITadmin_mail"];

try{
  require_once("./connectMeetain.php");
  $sql = "update product set    product_name=:product_name,
                                product_price=:product_price,
                                product_description=:product_description,
                                product_situation=:product_situation
                                where product_no=:product_no";
    $products=$pdo->prepare($sql);
    $products->bindValue(":product_name",$_REQUEST["EDITproduct_name"]);
    $products->bindValue(":product_price",$_REQUEST["EDITproduct_price"]);
    $products->bindValue(":product_description",$_REQUEST["EDITproduct_description"]);
    $products->bindValue(":product_situation",$_REQUEST["EDITproduct_situation"]);
    $products->bindValue(":product_no",$_REQUEST["product_no"]);
    $products->execute();
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}