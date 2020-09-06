<?php
$errMsg = "";

try{
    require_once("./connectMeetain.php");


    $sql = "update member_guide set mem_guide_verify = current_timestamp,
                                    mem_guide_situation = :mem_guide_situation
                                    where member_guide_no=:member_guide_no;";

    $products=$pdo->prepare($sql);
    $products->bindValue(":mem_guide_situation",$_REQUEST["VERIFYguideIfPass"]);
    $products->bindValue(":member_guide_no",$_REQUEST["member_guide_no"]);
    $products->execute();


}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>