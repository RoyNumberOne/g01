<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    $sql = "SELECT c.*, m.* FROM comment_post c join member m on c.comment_poster = m.mem_no where tour_post_no = :tour_no";

    $pdoStatement = $pdo->prepare($sql);
    // $pdoStatement = $pdo->query($sql);
    $pdoStatement->bindValue(":tour_no", 100001);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>