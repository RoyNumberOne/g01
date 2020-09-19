
<?php
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('connectMeetain.php');

    $mtName = $_GET["mtName"];
    
    $sql= "SELECT t.tour_mountain, mt.degree_category , mt.mountain_name , t.tour_build ,m.mem_id ,m.mem_avator,t.tour_title,mt.mountain_latitude,mt.mountain_longitude,t.tour_activitystart
    FROM tour t
            JOIN member m ON t.tour_hoster = m.mem_no
            JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
    WHERE t.tour_situation = 1 and tour_progress = '報名中' and mt.mountain_name = :tour_mountain
    ORDER BY t.tour_build DESC ;";
    
    $statement = $pdo -> prepare($sql);
    $statement -> bindValue(":tour_mountain" , $mtName); //套用變數
    // $statement -> bindValue(":tour_mountain" , '塔曼山' ); //套用變數
    $statement ->execute(); //執行mySQL指令

    $result = $statement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
    echo(json_encode($result));

    
}catch(PDOException $e){ // p83.                                                                                                                                                                
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }

?>

