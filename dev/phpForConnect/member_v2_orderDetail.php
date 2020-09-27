<?php

    require_once('connectMeetain.php');
    // echo $_POST['ordNo'];
    $ordNO = $_POST['ordNo'] ;
    // echo $ordNO;
    $sql = "SELECT product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價'  from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no join member on orders.member_no = member.mem_no where orders.order_no = $ordNO; ";
    $pdoStatement = $pdo->prepare($sql);
    // $pdoStatement->bindValue(":ordNo", $ordNO);
    $pdoStatement->execute();
    $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

    echo"<table class='prodDetail'>
        <tr class='cyan'><th width='110px'>商品預覽</th><th width='110px'>商品編號</th><th width='180px'>商品名稱</th><th width='80px' class='degree'>難度等級</th><th width='80px'>購買數量</th><th width='80px'>商品單價</th></tr>
        <h3 style='text-align: center;'>訂單商品<h3>";

    foreach ( $prodRows as $i => $prodRow){
    echo" <tr>
        <td><img src='".$prodRow['商品預覽']."' width='110px' alt=''></td>
        <td>".$prodRow['商品編號']."</td>
        <td style='text-decoration: underline;'><a href='./product_info.html?productNo=".$prodRow['商品編號']."'>".$prodRow['商品名稱']."</a></td>
        <td class='degree'>".$prodRow['難度等級']."</td>
        <td>".$prodRow['購買數量']."</td>
        <td>".$prodRow['商品單價']."</td>
        </tr>";
    };

    echo "</table>";

 ?>