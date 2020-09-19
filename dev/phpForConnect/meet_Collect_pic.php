<?php
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $tour_participate_tour = $_POST["tour_participate_tour"];
    $member_no = $_SESSION["mem_no"];
    try {
        require_once ('connectMeetain.php');
        //查詢
        $sql = "SELECT tour_keep_mem , tour_iskept_tour from tour_keep where tour_keep_mem = $member_no and tour_iskept_tour = $tour_participate_tour";
        $pdoStatement = $pdo->query($sql);
        $prodRowCounts = $pdoStatement->rowCount();
        // echo $prodRowCounts;    
    }
    
    catch(PDOException $e)
        {   
            echo $sql . "<br>" . $e->getMessage();
        }
}

?>
