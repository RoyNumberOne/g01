<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $forum_report_mem = $_SESSION['mem_no']; //誰檢舉
    $forum_post_no = $_POST['forum_post_no'];

    $sql = "SELECT cp.comment_no , cr.comment_report_mem from comment_report cr right outer join comment_post cp on ( cr.comment_report_comment = cp.comment_no and cr.comment_report_mem = $comment_report_mem) where cp.tour_post_no = $tour_post_no;";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>