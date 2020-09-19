<?php
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $product_no = $_POST["product_no"];
    $member_no = $_SESSION["mem_no"];
    try {
        require_once ('connectMeetain.php');
        //查詢
        $sql = "SELECT product_keep_mem , product_iskept_no from product_keep where product_keep_mem = $member_no and product_iskept_no = $product_no";
        $pdoStatement = $pdo->query($sql);
        $prodRowCounts = $pdoStatement->rowCount();
        // echo $prodRowCounts;   
        echo $prodRowCounts;
    }
    
    catch(PDOException $e)
        {   
            echo $sql . "<br>" . $e->getMessage();
        }
}
// else {
//     echo "請登入後收藏";
// }

?>
