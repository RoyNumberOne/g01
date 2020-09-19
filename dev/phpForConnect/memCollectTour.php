<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');

    session_start();
    $mem_no = $_SESSION['mem_no'];
    
    $sql= "SELECT tk.tour_keep_mem, tk.tour_iskept_tour, T.tour_no, T.tour_image_1, T.tour_title, T.tour_innertext, T.tour_build, M.mountain_image, M.mountain_name
                from tour_keep tk
                    join tour T on(tk.tour_iskept_tour = T.tour_no)
                    join mountain M on(T.tour_mountain = M.mountain_no)
                WHERE tk.tour_keep_mem = $mem_no
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