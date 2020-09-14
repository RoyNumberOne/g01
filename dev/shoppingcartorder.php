<?php
try {
    require_once ('connectMeetain.php');
    $member_no = 10009;
    $order_logistics_deliver = $_POST['order_logistics_deliver'];
    $order_cashflow = $_POST['order_cashflow'];
    $order_total = $_POST['order_total'];
    $order_logistics_recipient = $_POST['order_logistics_recipient'];
    $order_logistics_phone = $_POST['order_logistics_phone'];
    $order_logistics_address = $_POST['order_logistics_address'];
    //新增
	$sql = "INSERT INTO orders (member_no,order_logistics_deliver, order_cashflow , order_total , order_logistics_recipient , order_logistics_phone , order_logistics_address )
    VALUES ('$member_no','$order_logistics_deliver', '$order_cashflow','$order_total','$order_logistics_recipient','$order_logistics_phone','$order_logistics_address');";
    $pdoStatement = $pdo->query($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }
?>

