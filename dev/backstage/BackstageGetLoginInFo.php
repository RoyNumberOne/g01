<?php 
session_start();
if (isset($_SESSION["admin_acc"]) === true){
    //送出登入者的姓名資料
    $result = array("admin_no"=>$_SESSION["admin_no"],"admin_id"=>$_SESSION["admin_id"],"admin_name"=>$_SESSION["admin_name"],"admin_acc"=>$_SESSION["admin_acc"],"admin_psw"=>$_SESSION["admin_psw"],"admin_mail"=>$_SESSION["admin_mail"],"admin_authority"=>$_SESSION["admin_authority"],"admin_build"=>$_SESSION["admin_build"],"admin_avator"=>$_SESSION["admin_avator"]);
    echo json_encode($result);
}   else    {
    echo "{}";
}

?>