<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');

    session_start();
    $mem_no = $_SESSION['mem_no'];
    
    $sql= "SELECT T.tour_hoster, T.tour_no, T.tour_title,T.tour_innertext, T.tour_apply, T.tour_activitystart, M.mountain_image, M.mountain_area, M.degree_category, M.mountain_name
                from tour T
                    join mountain M on(T.tour_mountain = M.mountain_no)
                WHERE T.tour_hoster = $mem_no
                order BY T.tour_activitystart DESC;
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