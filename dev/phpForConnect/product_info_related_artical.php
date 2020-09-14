<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('../connectMeetain.php');
    
    // $sql= " SELECT * FROM forum_post where ...;

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>