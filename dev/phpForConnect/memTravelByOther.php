<?php
$errMsg = "";
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $mem_no = $_SESSION['mem_no'];

    $sql= "SELECT tp.tour_participate_mem, tp.tour_participate_tour, tp.tour_participate_situation, T.tour_hoster, T.tour_no, T.tour_title,T.tour_innertext, T.tour_activitystart, T.tour_activityend, T.tour_progress, T.tour_passed, M.mountain_image, M.mountain_area, M.degree_category, M.mountain_name
                from tour_participate tp
                    join tour T on(tp.tour_participate_tour = T.tour_no)
                    join mountain M on(T.tour_mountain = M.mountain_no)
                WHERE tp.tour_participate_mem = $mem_no 
                and T.tour_hoster != $mem_no
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