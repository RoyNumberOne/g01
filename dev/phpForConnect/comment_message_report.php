<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $comment_report_mem = $_SESSION['mem_no']; //誰檢舉
    $comment_report_comment = $_REQUEST['comment_report_comment'];  //檢舉哪篇留言
    $comment_report_reason = $_REQUEST['comment_report_reason']; //檢舉緣由

    $sql = "INSERT  INTO comment_report (comment_report_mem, comment_report_comment, comment_report_reason, comment_report_situation)
            VALUES ('$comment_report_mem', '$comment_report_comment', '$comment_report_reason', '未處理' );";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>