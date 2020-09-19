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
        //新增
        if($prodRowCounts == 0){
            $sql_1 = "INSERT INTO `tour_keep` (`tour_keep_mem`,`tour_iskept_tour`) VALUES ($member_no, $tour_participate_tour);";
            $pdoStatement = $pdo->query($sql_1);
            // echo "已加入收藏";
        }else{
            $sql_2="DELETE FROM `tour_keep` WHERE `tour_keep_mem` = $member_no AND `tour_iskept_tour` = $tour_participate_tour;";
            $pdoStatement = $pdo->query($sql_2);
            // echo "已移除收藏";
        }
        
    }
    
    catch(PDOException $e)
        {   
            echo $sql . "<br>" . $e->getMessage();
        }
  
}else    {
    echo "請登入後收藏";
}

?>
