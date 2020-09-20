<?php
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $forum_post_no = $_POST["forum_post_no"];
    $member_no = $_SESSION["mem_no"];
    try {
        require_once ('connectMeetain.php');
        //查詢
        $sql = "SELECT forum_keep_mem , forum_iskept_post from forum_keep where forum_keep_mem = $member_no and forum_iskept_post = $forum_post_no";
        $pdoStatement = $pdo->query($sql);
        $prodRowCounts = $pdoStatement->rowCount();
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
