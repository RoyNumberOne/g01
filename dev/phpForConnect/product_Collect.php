<?php
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $product_no = $_POST["product_no"];
    $member_no = $_SESSION["mem_no"];
    // echo $product_no;
    // echo $member_no;
    try {
        require_once ('connectMeetain.php');
        //查詢
        $sql = "SELECT product_keep_mem , product_iskept_no from product_keep where product_keep_mem = $member_no and product_iskept_no = $product_no";
        $pdoStatement = $pdo->query($sql);
        $prodRowCounts = $pdoStatement->rowCount();
        // echo $prodRowCounts;
        //新增
        if($prodRowCounts == 0){
            $sql_1 = "INSERT INTO `product_keep` (`product_iskept_no`,`product_keep_mem`) VALUES ($product_no, $member_no);";
            $pdoStatement = $pdo->query($sql_1);
            echo "已加入收藏";
        }else{
            $sql_2="DELETE FROM `product_keep` WHERE `product_keep_mem` = $member_no AND `product_iskept_no` = $product_no;";
            $pdoStatement = $pdo->query($sql_2);
            echo "已移除收藏";
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
