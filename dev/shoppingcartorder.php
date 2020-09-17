<?php
session_start();
if (isset($_SESSION["mem_acc"]) === true){
    //送出登入者的姓名資料
    $member_no = $_SESSION["mem_no"];
    $order_logistics_deliver = $_POST['order_logistics_deliver'];
    $order_logistics_fee = $_POST['order_logistics_fee'];
    $order_cashflow = $_POST['order_cashflow'];
    $order_total = $_POST['order_total'];
    $order_logistics_recipient = $_POST['order_logistics_recipient'];
    $order_logistics_phone = $_POST['order_logistics_phone'];
    $order_logistics_address = $_POST['order_logistics_address'];
    $arr = json_decode($_POST['arr'], true);
    try {
        require_once ('connectMeetain.php');
        //新增
        $sql = "INSERT INTO orders (member_no,order_logistics_deliver, order_logistics_fee , order_cashflow , order_total , order_logistics_recipient , order_logistics_phone , order_logistics_address )
        VALUES ('$member_no','$order_logistics_deliver','$order_logistics_fee','$order_cashflow','$order_total','$order_logistics_recipient','$order_logistics_phone','$order_logistics_address');";
        $pdoStatement = $pdo->query($sql);
            foreach($arr as $key => $value) {
                    $product_number = $value['numbers'];
                    $product_no = $value['product'];
                    $product_price = $value['price'];
            $sql = "INSERT INTO order_list (order_no,product_no, product_number, product_price) VALUES (last_insert_id(),'$product_no','$product_number','$product_price');";
                    $pdoStatement = $pdo->query($sql);
            }
   
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
    echo "訂單已送出";
    }
    
    catch(PDOException $e)
        {   
            echo $sql . "<br>" . $e->getMessage();
        }
  
}else    {
    echo "請登入會員後購買";
}

?>
