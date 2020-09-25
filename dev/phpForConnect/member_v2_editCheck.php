<?php
session_start();
try{
    require_once("connectMeetain.php");

    $sql = "select * from `member` where mem_id=:mem_id;";
    $mem_id = $_POST['mem_id'];
    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_id", $mem_id);
    $member ->execute();
    $mem_no = $_SESSION['mem_no'];

    if( $member->rowCount() !=0){
        echo "此暱稱已有人使用";
    }else{
        $sql = "update member set mem_id= :mem_id, 
                                    mem_mail= :mem_mail, 
                                    mem_psw= :mem_psw  
                                    where mem_no= $mem_no ;";

        $member=$pdo->prepare($sql);
        $mem_mail = $_POST['mem_mail'];
        $mem_psw = $_POST['mem_psw'];
        $member->bindValue(":mem_id", $mem_id);
        $member->bindValue(":mem_mail",$mem_mail);
        $member->bindValue(":mem_psw",$mem_psw);
        // $member->bindValue(":mem_no",$_REQUEST["mem_no"]);
        $member->execute();
        
        echo "修改成功";

        unset($_SESSION['mem_no']);
        unset($_SESSION['mem_id']);
        unset($_SESSION['mem_name']);
        unset($_SESSION['mem_acc']);
        unset($_SESSION['mem_psw']);
        unset($_SESSION['mem_mail']);
        unset($_SESSION['mem_build']);
        unset($_SESSION['mem_point']);
        unset($_SESSION['mem_avator']);
        unset($_SESSION['mem_bg']);
        unset($_SESSION['class']);
        unset($_SESSION['mem_badge1']);
        unset($_SESSION['mem_badge2']);
        unset($_SESSION['mem_badge3']);
        unset($_SESSION["guide_no"]);
        
    }
}catch (PDOException $e){
}
?>
