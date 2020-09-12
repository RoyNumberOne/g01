<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    $sql= "SELECT tk.tour_keep_mem, tk.tour_iskept_tour, T.tour_no, T.tour_image_1, T.tour_title, T.tour_innertext, T.tour_build
                from tour_keep tk
                    join tour T on(tk.tour_iskept_tour = T.tour_no)
                WHERE tk.tour_keep_mem = 10008  -- 之後改變數
                order BY T.tour_build DESC;
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