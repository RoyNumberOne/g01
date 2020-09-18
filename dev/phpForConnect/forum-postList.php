<?php
try{
    header("connect-type: text/html; charset=utf-8");
    require_once('./connectMeetain.php');

    $POSTno = 1;
    $sql= " SELECT `forum_post_category`, `forum_post_image`, `forum_post_time`FROM `forum_post`  where `forum_post_no` = $POSTno ;";

    $pdoStatement = $pdo->query($sql); //執行mySQL指令
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
    echo(json_encode($result));
    
}catch(PDOException $e){ // p83.
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>