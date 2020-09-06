<?php
$errMsg = "";

try{
    require_once("./connectMeetain.php");


    $sql = "update member set   ban_forum=1 ,
                                ban_forum_date=date_add(current_timestamp, interval :forum_report_banLong minute ) 
                                where mem_no=:mem_no;";

    $products=$pdo->prepare($sql);
    $products->bindValue(":forum_report_banLong",$_REQUEST["REVIEWfrBanLong"]);
    $products->bindValue(":mem_no",$_REQUEST["REVIEWfrMember"]);
    $products->execute();

  

    $sql = "update forum_report set  forum_report_situation=:forum_report_situation ,   
                                    forum_report_banLong=:forum_report_banLong
                                    where forum_report_no=:forum_report_no;";
    $products=$pdo->prepare($sql);
    $products->bindValue(":forum_report_situation",$_REQUEST["REVIEWfrIfPass"]);
    if ($_REQUEST["REVIEWfrBanLong"] == 5) {
        $products->bindValue(":forum_report_banLong",($_REQUEST["REVIEWfrBanLong"].' minutes'));
    }   else {
        $products->bindValue(":forum_report_banLong",(($_REQUEST["REVIEWfrBanLong"]/1440).' days'));
    }
    $products->bindValue(":forum_report_no",$_REQUEST["forum_report_no"]);
    $products->execute();

  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>