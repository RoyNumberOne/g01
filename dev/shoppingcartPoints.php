<?php	
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $member_no = $_SESSION["mem_no"];	
	try	{
        require_once('connectMeetain.php');
        $sql = "SELECT mem_point FROM member WHERE `mem_no`= $member_no";
        $pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }   catch	(PDOException $e)	{
	}
        echo $prodRows['mem_point'];
}else{

        echo    "請登入會員查看";
}
?>
