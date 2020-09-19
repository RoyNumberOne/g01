<?php
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $forum_post_no = $_POST["forum_post_no"];
    $member_no = $_SESSION["mem_no"];
    // echo $forum_post_no_no;
    // echo $member_no;
    try {
        require_once('connectMeetain.php');
        //查詢
        $sql = "SELECT forum_keep_mem , forum_iskept_post from forum_keep where forum_keep_mem = $member_no and forum_iskept_post = $forum_post_no";
        $pdoStatement = $pdo->query($sql);
        $prodRowCounts = $pdoStatement->rowCount();
        echo $prodRowCounts;
        //新增
        if($prodRowCounts == 0){
            $sql_1 = "INSERT INTO `forum_keep` (`forum_iskept_post`,`forum_keep_mem`) VALUES ($forum_post_no, $member_no);";
            $pdoStatement = $pdo->query($sql_1);
            // echo "已加入收藏";
        }else{
            $sql_2="DELETE FROM `forum_keep` WHERE `forum_keep_mem` = $member_no AND `forum_iskept_post` = $forum_post_no;";
            $pdoStatement = $pdo->query($sql_2);
            // echo "已移除收藏";
        }
        
    }
    
    catch(PDOException $e)
        {   
            echo $sql . "<br>" . $e->getMessage();
        }
  
}else    {
    // echo "請登入後收藏";
}

?>
