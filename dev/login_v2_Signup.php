<?php
try{
//前端送來的資料
    require_once ("./connectMeetain.php");
    $mem_acc = $_GET["mem_acc"];

    $sql = "select * from `member` where mem_acc=:mem_acc";
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_acc", $mem_acc);
    $member ->execute();
// 判斷帳號是否使用過

    if( $member->rowCount() !=0){
        echo "此帳號未使用";
    }else{
        echo "此帳號已使用";
    }

}catch(PDOException $e){
    $e->getMessage();
}
?>