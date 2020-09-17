<?php	
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $member_no = $_SESSION["mem_no"];	
	try	{
        require_once('connectMeetain.php');
        // $mem_no = ; 先給預設 這裡之後要抓session的會員身份
        $sql = "SELECT mem_point FROM member WHERE `mem_no`= $member_no";
        $pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }   catch	(PDOException $e)	{
	}
?>
    <div>點數餘額：
        <span id="momey">
        <?=$prodRows['mem_point']?>
        </span>
    </div>
<?php
}else{
?>
    <div>點數餘額：
        <span id="momey">
            請登入會員查看
        </span>
    </div>
<?php
}
?>
