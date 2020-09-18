<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');

    session_start();
    $mem_no = $_SESSION['mem_no'];
    
    $sql= "SELECT pk.product_keep_mem, pk.product_iskept_no, P.product_no, P.product_image1, P.product_name, P.product_description
                from product_keep pk
                    join product P on(pk.product_iskept_no = P.product_no)
                WHERE pk.product_keep_mem = $mem_no  -- 之後改變數and
                order BY P.product_no DESC; -- 因為沒有建立日期所以用編號排序
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