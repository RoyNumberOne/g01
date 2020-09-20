<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $forum_report_mem = $_SESSION['mem_no']; //誰檢舉
    $forum_post_no = $_POST['forum_post_no'];
    
    $sql = "SELECT forum_post_no , forum_report_mem
            from  forum_report right outer join forum_post on 
            (forum_report_post = forum_post_no and forum_report_mem = $forum_report_mem) where forum_post_no = $forum_post_no;";
    

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