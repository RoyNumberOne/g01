<?php
$errMsg = "";
try{
//前端送來的資料
    require_once("connectMeetain.php");

    $sql = "select * from `member` where mem_id=:mem_id";
    $mem_id = $_POST['mem_id'];
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_id", $mem_id);
    $member ->execute();

// 判斷帳號是否使用過

    if( $member->rowCount() !=0){
        echo "此暱稱已有人使用";
    }else{
        $sql = "update member set   mem_id=:mem_id,
                                    mem_mail=:mam_mail,
                                    mem_psw=:mem_psw
                                    where mem_no=:mem_no";
        $member=$pdo->prepare($sql);
        $member->bindValue(":mem_id",$_POST["mem_id"]);
        $member->bindValue(":mem_mail",$_POST["mem_mail"]);
        $member->bindValue(":mem_psw",$_POST["mem_psw"]);
        $member->bindValue(":mem_no",$_POST["mem_no"]);
        $member->execute();

        echo "修改成功";
    }

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}
?>