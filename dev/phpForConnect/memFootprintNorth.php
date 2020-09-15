<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    $sql= "SELECT tp.tour_participate_mem, tp.tour_participate_tour, T.tour_no, T.tour_progress, T.tour_activitystart, T.tour_activityend, M.mountain_image, M.mountain_area, M.mountain_name, M.degree_category
                from tour_participate tp
                    join tour T on(tp.tour_participate_tour = T.tour_no)
                    join mountain M on(T.tour_mountain = M.mountain_no)
                WHERE tp.tour_participate_mem = 10009  -- 之後改變數  
                and T.tour_progress = '已結束' 
                and M.mountain_area = 'north'  -- 北部
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