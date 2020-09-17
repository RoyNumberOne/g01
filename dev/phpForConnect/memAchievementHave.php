<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    // $sql= "SELECT ma.achievement_no, ma.achievement_date, M.mem_no, M.mem_name, A.achievement_name, A.achievement_image, A.achievement_category
    //             from mem_achievement ma
    //                 join member M on(ma.mem_no = M.mem_no)
    //                 join achievement A on(ma.achievement_no = A.achievement_no)
    //             WHERE ma.mem_no = 10006  -- 之後改變樹
    //             order by ma.achievement_date desc;
    //             ";

    session_start();
    $mem_no = $_SESSION['mem_no'];

    $sql="SELECT a.achievement_no, a.achievement_category , a.achievement_name , a.achievement_require , a.achievement_image , ma.mem_no , ma.achievement_date
            from achievement a
            left outer join mem_achievement ma on ( a.achievement_no = ma.achievement_no and ma.mem_no = $mem_no)
            group by a.achievement_no , ma.achievement_no;
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