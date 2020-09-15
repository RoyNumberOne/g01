<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    $sql = "SELECT * FROM comment_post where tour_post_no = :tour_no";

    $pdoStatement = $pdo->prepare($sql);
    // $pdoStatement = $pdo->query($sql);
    $pdoStatement->bindValue(":tour_no", 100003);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>