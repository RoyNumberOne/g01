<?php
$errMsg='';
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



$sql="SELECT  m.mem_no ,m.mem_badge1 , a1.achievement_image 'badge1' , a1.achievement_category 'category1' ,a1.achievement_name 'name1' , m.mem_badge2 , a2.achievement_image 'badge2' , a2.achievement_category 'category2' ,a2.achievement_name 'name2' , m.mem_badge3 , a3.achievement_image 'badge3' , a3.achievement_category 'category3' ,a3.achievement_name 'name3'
    FROM member m
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
    WHERE m.mem_no = $mem_no ";

$pdoStatement = $pdo->query($sql); //執行mySQL指令
$result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
echo(json_encode($result));



}catch(PDOException $e){ // p83.
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>