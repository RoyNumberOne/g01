
<?php
try {
	require_once ('connectMeetain.php');
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_acc = $_POST['admin_acc'];
    $admin_psw = $_POST['admin_psw'];
    $admin_mail = $_POST['admin_mail'];
	// 建立管理員後台帳戶
	$sql = "INSERT INTO administrator (admin_id, admin_name , admin_acc , admin_psw , admin_mail )
    VALUES ('$admin_id', '$admin_name','$admin_acc','$admin_psw','$admin_mail');";
    $pdoStatement = $pdo->query($sql);
    echo "New record created successfully";
    console.log(345);

    // 建立管理員前台帳戶
    $sql = "INSERT INTO member (mem_id, mem_name , mem_acc , mem_psw , mem_mail )
    VALUES ('$admin_id', '$admin_name','$admin_acc','$admin_psw','$admin_mail');";
    $pdoStatement = $pdo->query($sql);
    echo "New record created successfully";
    console.log(456);
	// $pdoStatement = $pdo->exec($sql);
	// $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

    // $pdo->exec($sql);
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

$sql = null;
?>