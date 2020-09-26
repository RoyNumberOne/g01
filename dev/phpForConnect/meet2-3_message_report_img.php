<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $comment_report_mem = $_SESSION['mem_no']; //誰檢舉
    // $comment_report_comment = $_REQUEST['comment_report_comment'];  //檢舉哪篇留言
    $tour_post_no = $_REQUEST['tour_post_no']; //哪一篇
    
    $sql = "SELECT cp.comment_no , cr.comment_report_mem from comment_report cr right outer join comment_post cp on ( cr.comment_report_comment = cp.comment_no and cr.comment_report_mem = $comment_report_mem) where cp.tour_post_no = $tour_post_no order by cp.comment_time;";
    

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>