<?php
try{
    header("Content-type: text/html; charset=utf-8");

    require_once('connectMeetain.php');

    $sql=" SELECT p.product_no , p.product_name , count(*) , p.product_price , p.product_description , p.product_image1 from product p join order_list o on p.product_no = o.product_no where product_situation = 1 group by o.product_no order by count(*) desc limit 4 ;    ";

    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));

}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>