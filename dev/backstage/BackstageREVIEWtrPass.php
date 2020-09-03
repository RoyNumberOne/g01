<script>console.log('step0')</script>

<?php
$errMsg = "";

try{
    require_once("./connectMeetain.php");


    $sql = "update member set   ban_tour=1 ,
                                ban_tour_date=date_add(current_timestamp, interval :tour_report_banLong minute ) 
                                where mem_no=:mem_no;";

    $products=$pdo->prepare($sql);
    $products->bindValue(":tour_report_banLong",$_REQUEST["REVIEWtrBanLong"]);
    $products->bindValue(":mem_no",$_REQUEST["REVIEWtrMember"]);
    $products->execute();

  

    $sql = "update tour_report set  tour_report_situation=:tour_report_situation ,   
                                    tour_report_banLong=:tour_report_banLong
                                    where tour_report_no=:tour_report_no;";
    $products=$pdo->prepare($sql);
    $products->bindValue(":tour_report_situation",$_REQUEST["REVIEWtrIfPass"]);
    if ($_REQUEST["REVIEWtrBanLong"] == 5) {
        $products->bindValue(":tour_report_banLong",($_REQUEST["REVIEWtrBanLong"].' minutes'));
    }   else {
        $products->bindValue(":tour_report_banLong",(($_REQUEST["REVIEWtrBanLong"]/1440).' days'));
    }
    $products->bindValue(":tour_report_no",$_REQUEST["tour_report_no"]);
    $products->execute();

  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}

?>
<script>console.log('step1')</script>