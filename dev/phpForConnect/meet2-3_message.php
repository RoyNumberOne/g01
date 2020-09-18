<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $comment_poster = $_SESSION['mem_no'];
    $comment_class = $_REQUEST['comment_class'];
    $tour_post_no = $_REQUEST['tour_post_no'];
    $comment_innertext = $_REQUEST['comment_innertext'];

    $sql = "INSERT  INTO comment_post (comment_poster, comment_class, tour_post_no, comment_innertext)
            VALUES ($comment_poster, '$comment_class' , '$tour_post_no' , '$comment_innertext' );";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);


    // $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    // echo(json_encode($result));

    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>