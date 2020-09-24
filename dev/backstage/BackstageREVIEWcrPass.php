<?php
$errMsg = "";

try{
    require_once("./connectMeetain.php");

    if ($_REQUEST['REVIEWcrClass'] == '揪團區') {
        
        $sql = "update member set   ban_comment_date=date_add(current_timestamp, interval :comment_report_banLong minute ) 
                                    where mem_no=:mem_no;";

        $products=$pdo->prepare($sql);
        $products->bindValue(":comment_report_banLong",$_REQUEST["REVIEWcrBanLong"]);
        $products->bindValue(":mem_no",$_REQUEST["REVIEWcrMember"]);
        $products->execute();



        $sql = "update comment_report set   comment_report_situation=:comment_report_situation ,   
                                            comment_report_banLong=:comment_report_banLong
                                            where comment_report_no=:comment_report_no;";
        $products=$pdo->prepare($sql);
        $products->bindValue(":comment_report_situation",$_REQUEST["REVIEWcrIfPass"]);
        if ($_REQUEST["REVIEWcrBanLong"] == 5) {
            $products->bindValue(":comment_report_banLong",($_REQUEST["REVIEWcrBanLong"].' minutes'));
        }   else {
            $products->bindValue(":comment_report_banLong",(($_REQUEST["REVIEWcrBanLong"]/1440).' days'));
        }
        $products->bindValue(":comment_report_no",$_REQUEST["comment_report_no"]);
        $products->execute();


        $sql = "UPDATE comment_post set comment_situation = 0 where comment_no=:REVIEWcrNo;";
        $products=$pdo->prepare($sql);
        $products->bindValue(":REVIEWcrNo",$_REQUEST["REVIEWcrNo"]);
        $products->execute();

    }   else {

        $sql = "update member set   ban_comment_date=date_add(current_timestamp, interval :comment_report_banLong minute ) 
                                    where mem_no=:mem_no;";

        $products=$pdo->prepare($sql);
        $products->bindValue(":comment_report_banLong",$_REQUEST["REVIEWcrBanLong"]);
        $products->bindValue(":mem_no",$_REQUEST["REVIEWcrMember"]);
        $products->execute();



        $sql = "update comment_report set   comment_report_situation=:comment_report_situation ,   
                                            comment_report_banLong=:comment_report_banLong
                                            where comment_report_no=:comment_report_no;";
        $products=$pdo->prepare($sql);
        $products->bindValue(":comment_report_situation",$_REQUEST["REVIEWcrIfPass"]);
        if ($_REQUEST["REVIEWcrBanLong"] == 5) {
            $products->bindValue(":comment_report_banLong",($_REQUEST["REVIEWcrBanLong"].' minutes'));
        }   else {
            $products->bindValue(":comment_report_banLong",(($_REQUEST["REVIEWcrBanLong"]/1440).' days'));
        }
        $products->bindValue(":comment_report_no",$_REQUEST["comment_report_no"]);
        $products->execute();

        $sql = "UPDATE comment_post set comment_situation = 0 where comment_no=:REVIEWcrNo;";
        $products=$pdo->prepare($sql);
        $products->bindValue(":REVIEWcrNo",$_REQUEST["REVIEWcrNo"]);
        $products->execute();
        
    }



  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>