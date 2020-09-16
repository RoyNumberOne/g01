<?php

$errMsg ="";

try{
    header("Content-type: text/html; charset=utf-8");

    require_once('connectMeetain.php');

    $forum_post_no = $_POST['forum_post_no'];

    $sql="SELECT forum_post_no, mem_no, forum_post_poster, forum_post_category, forum_post_image, forum_post_time, forum_post_title, forum_post_innertext, mem_id
	    from forum_post
            join member on(mem_no = forum_post_poster)
	        -- where forum_post_situation = 1 and forum_post_category  not in ('公告')
            where forum_post_no = '$forum_post_no' and forum_post_situation = 1 and forum_post_category not in ('公告')
            group by forum_post_no;";

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo (json_encode($result));

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>