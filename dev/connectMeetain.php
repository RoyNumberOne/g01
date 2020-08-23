<?php 
	// $dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	// $user = "root";
	// $password = "root";
	// $options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	// $pdo = new PDO($dsn , $user , $password, $options);
?>


<?php 
try	{
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
	if($pdo != false){
		echo "連線成功<br>";
	}	else	{
		echo "<br>失敗ㄌ<br>";
	}
}	catch	(PDOException $e)	{
	echo "錯誤原因：",$e->getMessage(), "<br>";
	echo "錯誤行號：",$e->getLine(),"<br>";
}
?>