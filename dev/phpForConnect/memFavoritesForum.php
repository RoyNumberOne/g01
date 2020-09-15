<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    $sql= "SELECT fk.forum_keep_mem,fk.forum_iskept_post,fp.forum_post_no,fp.forum_post_title,fp.forum_post_image,fp.forum_post_innertext,fp.forum_post_time, fp.forum_post_category
                from forum_keep fk 
                    join forum_post fp on(fk.forum_iskept_post = fp.forum_post_no)
                WHERE fk.forum_keep_mem = 10008 -- :test
                order BY fp.forum_post_time DESC;
                ";

    // $statement = $pdo -> prepare($sql);
    // //$statement -> bindValue(":forum_keep_mem" , $mtN); //套用變數
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