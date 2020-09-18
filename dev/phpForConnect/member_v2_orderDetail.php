</table>
    <hr> 
<?php
    $sql = "SELECT product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價'  from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no join member on orders.member_no = member.mem_no where member_no = $memNO and orders.order_no = order_list.order_no; ";
    $pdoStatement = $pdo->query($sql);
    $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
?>
    <table class="prodDetail">
    <tr class='cyan'><th width='110px'>商品預覽</th><th width='110px'>商品編號</th><th width='200px'>商品名稱</th><th width='80px'>難度等級</th><th width='80px'>購買數量</th><th width='80px'>商品單價</th></tr>
    <h3 style="text-align: center;">訂單商品<h3>
<?php
    foreach ( $prodRows as $i => $prodRow){
?>
    <tr>
        <td><img src="<?=$prodRow["商品預覽"]?>" width='110px' alt=''></td>
        <td><?=$prodRow["商品編號"]?></td>
        <td><?=$prodRow["商品名稱"]?></td>
        <td><?=$prodRow["難度等級"]?></td>
        <td><?=$prodRow["購買數量"]?></td>
        <td><?=$prodRow["商品單價"]?></td>
    </tr>
</table>
<?php } ?>