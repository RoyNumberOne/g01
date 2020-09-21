<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    //送出登入者的姓名資料
    $forum_report_mem = $_SESSION['mem_no']; //誰檢舉
    $forum_report_post = $_REQUEST['forum_report_post'];  //檢舉哪篇留言
    $forum_report_reason = $_REQUEST['forum_report_reason']; //檢舉緣由

    $sql = "INSERT  INTO forum_report (forum_report_mem, forum_report_post, forum_report_reason, forum_report_situation)
            VALUES ('$forum_report_mem', '$forum_report_post', '$forum_report_reason', '未處理' );";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>