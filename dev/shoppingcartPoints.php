<?php		
	try	{
        require_once('connectMeetain.php');
        // $mem_no = ; 先給預設 這裡之後要抓session的會員身份
        $mem_no = 10001;
        $sql = "SELECT mem_point FROM member WHERE `mem_no`= $mem_no";
        $pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        // echo "點數餘額：".$prodRow['mem_point'];
    }   catch	(PDOException $e)	{
	}
?>
    <div>點數餘額：
        <span id="momey">
        <?=$prodRows['mem_point']?>
        </span>
    </div>
