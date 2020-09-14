<?php
try {
    require_once ('connectMeetain.php');
    $member_no = 10001;
    $order_logistics_deliver = $_POST['order_logistics_deliver'];
    $order_cashflow = $_POST['order_cashflow'];
    $order_total = $_POST['order_total'];
    // $order_total = 24000;
    $order_logistics_recipient = $_POST['order_logistics_recipient'];
    $order_logistics_phone = $_POST['order_logistics_phone'];
    $order_logistics_address = $_POST['order_logistics_address'];
    //新增
	$sql = "INSERT INTO orders (member_no,order_logistics_deliver, order_cashflow , order_total , order_logistics_recipient , order_logistics_phone , order_logistics_address )
    VALUES ('$member_no','$order_logistics_deliver', '$order_cashflow','$order_total','$order_logistics_recipient','$order_logistics_phone','$order_logistics_address');";
    $pdoStatement = $pdo->query($sql);
    
    if($order_cashflow =='點數付款' ){
         //查詢
        $sql = "SELECT mem_point from member where mem_no = $member_no";
        $pdoStatement = $pdo->query($sql);
        $prodRows = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $Now_point = $prodRows['mem_point'];
        $Now_point;
        
        $my_points = $Now_point - $order_total;
        //修改
        $sql = "update member set  mem_point=:mem_point where mem_no = $member_no";
        $memberpoint=$pdo->prepare($sql);
        $memberpoint->bindValue(":mem_point",$my_points);
        $memberpoint->execute();
    }
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }
?>

