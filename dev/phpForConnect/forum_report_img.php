<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $forum_report_mem = $_SESSION['mem_no']; //誰檢舉
    // $comment_report_comment = $_REQUEST['comment_report_comment'];  //檢舉哪篇留言
    $forum_post_no = $_REQUEST['forum_post_no'];
    
    $sql = "SELECT f.forum_post_no , fr.forum_report_mem from forum_report fr right outer join forum_post f on ( fr.forum_report_post = f.forum_post_no and fr.forum_report_mem = $forum_report_mem) where f.forum_post_no = $forum_post_no;";
    

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