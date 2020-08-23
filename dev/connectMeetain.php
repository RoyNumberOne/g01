<?php 
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
?>


<?php 
try	{
	require_once('connectMeetain.php');
	if($pdo != false){
		echo "連線成功<br>";
		// $sql = 'select count(*) from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_sitution = "未處理";';

		
		foreach($pdo->query('SELECT COUNT(*) FROM comment_report cr JOIN comment_post cp ON cr.comment_report_comment = cp.comment_no WHERE cr.comment_report_sitution = "未處理"') as $row) {
			echo "<tr>";
			echo "<td>" . $row['COUNT(*)'] . "</td>";
			echo "</tr>";
			}

	}	else	{
		echo "<br>失敗ㄌ<br>";
	}
}	catch	(PDOException $e)	{
	echo "錯誤原因：",$e->getMessage(), "<br>";
	echo "錯誤行號：",$e->getLine(),"<br>";
}
?>