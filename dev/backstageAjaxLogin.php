<?php
session_start();
try{
  require_once("./connectMeetain.php");
  $sql = "select * from `administrator` where admin_acc=:admin_acc and admin_psw=:admin_psw"; 
  $administrator = $pdo -> prepare($sql);
  $administrator->bindValue(":admin_acc",$_POST["admin_acc"]);
  $administrator->bindValue(":admin_psw",$_POST["admin_psw"]);
  $administrator->execute();
  if( $administrator->rowCount()==0){ //查無此人
	  echo "{}";
  }else{ //登入成功
    //自資料庫中取回資料
    $adminRow = $administrator->fetch(PDO::FETCH_ASSOC);
    //將登入者的資料先寫入session
    $_SESSION["admin_no"] = $adminRow["admin_no"];
    $_SESSION["admin_id"] = $adminRow["admin_id"];
    $_SESSION["admin_name"] = $adminRow["admin_name"];
    $_SESSION["admin_acc"] = $adminRow["admin_acc"];
    $_SESSION["admin_psw"] = $adminRow["admin_psw"];
    $_SESSION["admin_mail"] = $adminRow["admin_mail"];
    $_SESSION["admin_authority"] = $adminRow["admin_authority"];
    $_SESSION["admin_build"] = $adminRow["admin_build"];
    //送出登入者的姓名資料
    $result = array("admin_no"=>$adminRow["admin_no"],
                    "admin_id"=>$adminRow["admin_id"],
                    "admin_name"=>$adminRow["admin_name"],
                    "admin_acc"=>$adminRow["admin_acc"],
                    "admin_psw"=>$adminRow["admin_psw"],
                    "admin_mail"=>$adminRow["admin_mail"],
                    "admin_authority"=>$adminRow["admin_authority"],
                    "admin_build"=>$adminRow["admin_build"]);
    echo json_encode($result);
    // echo $adminRow["memName"];
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

