<?php
$errMsg = "";

try{
    require_once("./connectMeetain.php");


    $sql = "update member_realname set  mem_realname_verify = current_timestamp,
                                        mem_realname_situation = :mem_realname_situation
                                        where member_realname_no=:member_realname_no;";

    $products=$pdo->prepare($sql);
    $products->bindValue(":mem_realname_situation",$_REQUEST["VERIFYnameIfPass"]);
    $products->bindValue(":member_realname_no",$_REQUEST["member_realname_no"]);
    $products->execute();


}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>