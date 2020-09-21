<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $tour_participate_tour = $_REQUEST['tour_participate_tour']; //哪一團

    if($_SESSION['mem_no']==null){
        $tour_participate_mem = 10000 ; // 給一個不會出現的人
    }   else    {
        $tour_participate_mem = $_SESSION['mem_no']; //誰登入
    }
    // echo $tour_participate_mem;
    $sql = "SELECT tour_participate_mem , tour_participate_situation as sti from tour_participate where tour_participate_tour = $tour_participate_tour and tour_participate_mem = $tour_participate_mem;";
    
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);

    $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    $sti = $result['sti'];
    echo $sti;
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    echo $errMsg ;
    }
?>