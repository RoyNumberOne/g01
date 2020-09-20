<?php
$errMsg = "";
try{
    require_once('./connectMeetain.php');
    
     //抓取會員資訊
     session_start();
     $mem_no = $_SESSION["mem_no"]; // 變數（會員號碼） ＝ session 抓會員號碼

     $forumList_forum_post_no = isset($_GET["forumList_forum_post_no"]) ? $_GET["forumList_forum_post_no"] : 1;

    // $forum_no = $_GET["forum_no"];
    // $forum_no = '100012';  //mem_no = 10018

    $sql= " DELETE from forum_keep 
                where forum_keep_mem = '$mem_no' and forum_iskept_post = '$forumList_forum_post_no';
     ";

    $pdoStatement = $pdo->query($sql); //執行mySQL指令
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
    
    

}catch(PDOException $e){ // p83.
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>