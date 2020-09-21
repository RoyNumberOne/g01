<?php
try{
//前端送來的資料
    require_once("./connectMeetain.php");
    
    $sql = "select * from `member` where mem_id=:mem_id;";

    $mem_id = $_POST['mem_id'];
    $mem_acc = $_POST['mem_acc'];
    $mem_name = $_POST['mem_name'];
    $mem_psw = $_POST['mem_psw'];
    $mem_mail = $_POST['mem_mail'];

    $member = $pdo->prepare($sql);
    $member->bindValue(":mem_id", $mem_id);
    $member ->execute();
// 判斷帳號是否使用過

    if( $member->rowCount() !=0){
        echo "此暱稱已被使用";
    }else {
        require_once("./connectMeetain.php");
        
        $sql = "select * from `member` where mem_acc=:mem_acc;";
        $member = $pdo->prepare($sql);
        $member->bindValue(":mem_acc", $mem_acc);
        $member ->execute();

        if( $member->rowCount() !=0){
            echo "此帳號已被使用";
        }   else    {
            $sql = "INSERT INTO member (mem_id, mem_name , mem_acc , mem_psw , mem_mail )
            VALUES ('$mem_id', '$mem_name','$mem_acc','$mem_psw','$mem_mail');";

            $member = $pdo->prepare($sql);
            $member->bindValue(":mem_id", $mem_id);
            $member->bindValue(":mem_name", $mem_name);
            $member->bindValue(":mem_acc", $mem_acc);
            $member->bindValue(":mem_psw", $mem_psw);
            $member->bindValue(":mem_mail", $mem_mail);
            $member ->execute();
    
            session_start();
            $sql = "select * from `member` where mem_acc=:mem_acc";
            $member = $pdo->prepare($sql);
            $member->bindValue(":mem_acc", $mem_acc);
            $member->execute();
    
            $memRow = $member->fetch(PDO::FETCH_ASSOC);
    
            $_SESSION["mem_no"] = $memRow["mem_no"];
            $_SESSION["mem_id"] = $memRow["mem_id"];
            $_SESSION["mem_name"] = $memRow["mem_name"];
            $_SESSION["mem_acc"] = $memRow["mem_acc"];
            $_SESSION["mem_psw"] = $memRow["mem_psw"];
            $_SESSION["mem_mail"] = $memRow["mem_mail"];
            $_SESSION["mem_build"] = $memRow["mem_build"];
            $_SESSION["mem_point"] = $memRow["mem_point"];
            $_SESSION["mem_avator"] = $memRow["mem_avator"];
            $_SESSION["mem_bg"] = $memRow["mem_bg"];
            $_SESSION["class"] = $memRow["class"];
            $_SESSION["guide_no"] = $memRow["guide_no"];
            $_SESSION["mem_badge1"] = $memRow["mem_badge1"];
            $_SESSION["mem_badge2"] = $memRow["mem_badge2"];
            $_SESSION["mem_badge3"] = $memRow["mem_badge3"];
    
            $result = array("mem_no"=>$memRow["mem_no"], 
                            "mem_id"=>$memRow["mem_id"],
                            "mem_name"=>$memRow["mem_name"],
                            "mem_acc"=>$memRow["mem_acc"],
                            "mem_psw"=>$memRow["mem_psw"],
                            "mem_mail"=>$memRow["mem_mail"],
                            "mem_build"=>$memRow["mem_build"],
                            "mem_point"=>$memRow["mem_point"],
                            "mem_avator"=>$memRow["mem_avator"],
                            "mem_bg"=>$memRow["mem_bg"],
                            "class"=>$memRow["class"],
                            "guide_no"=>$memRow["guide_no"],
                            "mem_badge1"=>$memRow["mem_badge1"],
                            "mem_badge2"=>$memRow["mem_badge2"],
                            "mem_badge3"=>$memRow["mem_badge3"]);
    
            echo "帳號註冊成功";
        }
    }

}catch(PDOException $e){
    echo $e->getMessage();
}
?>