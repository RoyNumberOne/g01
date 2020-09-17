<?php
session_start();
try	{
    require_once('connectMeetain.php');

    $memNO = $_SESSION["mem_no"] ;

    if(isset($_SESSION["mem_no"]) === true){
        $sql = "SELECT order_no '訂單編號' , member_no '會員編號' ,order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_cashflow '付款方式' , order_position '訂單狀態' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders join member on orders.member_no = member.mem_no where member_no = $memNO order by order_no; " ;
        $pdoStatement = $pdo->query($sql);
        $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <table>
        <tr class='cyan'><th>訂單編號</th><th>會員編號</th><th>收件人</th><th width="110px">聯絡電話</th><th>付款方式</th><th>訂單狀態</th><th>付款金額</th><th>訂單成立時間</th></tr>
    <?php
        foreach ( $prodRows as $i => $prodRow){
    ?>
        <tr>
        <td><a class="showDetail"><?=$prodRow["訂單編號"]?></a></td>
        <td><?=$prodRow["會員編號"]?></td>
        <td><?=$prodRow["收件人"]?></td>
        <td><?=$prodRow["聯絡電話"]?></td>
        <td><?=$prodRow["付款方式"]?></td>
        <td><?=$prodRow["訂單狀態"]?></td>
        <td><?=$prodRow["付款金額"]?></td>
        <td><?=$prodRow["訂單成立時間"]?></td>
        </tr>
    <?php } ?>
        </table>
        <hr>
        
    <?php
        $sql = "SELECT product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價'  from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no join member on orders.member_no = member.mem_no where member_no = $memNO and orders.order_no = order_list.order_no; " ;
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
    <?php } ?>

    
    <script>
        $(".prodDetail").hide();

        $(document).ready(function(){
            $(".showDetail").click(function(){
                $(".prodDetail").show();
            });
        });
    </script>
    <?php
    }else{
        echo "錯誤";
    }

}catch	(PDOException $e){
}
?>