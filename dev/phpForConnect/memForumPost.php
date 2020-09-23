<?php
$errMsg = "";
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $mem_no = $_SESSION['mem_no'];

    $sql= "SELECT max(cp.comment_time) as 'Max', fp.forum_post_poster, fp.forum_post_no, fp.forum_post_title, fp.forum_post_image, fp.forum_post_innertext, fp.forum_post_time, fp.forum_post_category
                from comment_post cp
                    right join forum_post fp on(cp.forum_post_no = fp.forum_post_no)
                    WHERE fp.forum_post_poster = $mem_no and fp.forum_post_situation = 1
                    GROUP by  fp.forum_post_poster, cp.forum_post_no, fp.forum_post_no
                    order BY fp.forum_post_time DESC;
                ";

    // $statement = $pdo -> prepare($sql);
    // //$statement -> bindValue(":tour_keep_mem" , $mtN); //套用變數
    // $statement -> bindValue(":test" ,10008); //套用變數
    // $statement ->execute(); //執行mySQL指令

    $pdoStatement = $pdo->query($sql); //執行mySQL指令
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
    echo(json_encode($result));
    
}catch(PDOException $e){ // p83.
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>