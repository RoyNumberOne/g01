<?php 
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $result = array("mem_no"=>$_SESSION["mem_no"],"mem_id"=>$_SESSION["mem_id"],"mem_name"=>$_SESSION["mem_name"],"mem_acc"=>$_SESSION["mem_acc"],"mem_psw"=>$_SESSION["mem_psw"],"mem_mail"=>$_SESSION["mem_mail"],"mem_build"=>$_SESSION["mem_build"],"mem_point"=>$_SESSION["mem_point"]);
    echo json_encode($result);
}   else    {
    echo "{}";
}

?>