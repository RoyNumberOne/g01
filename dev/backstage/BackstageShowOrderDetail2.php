<?php
    if(isset($_POST['orderSearchBar'])){
        $orderSearchBar = $_POST['orderSearchBar'];
		$searchKey = $_POST['searchKey'];
		
	try	{
		require_once('connectMeetain.php');

		$sql = "SELECT order_no '訂單編號' , member_no '會員編號' , order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_logistics_deliver '運送方式' , order_cashflow '付款方式' , order_position '訂單狀態' , order_logistics_address '收件地址' , order_total '原始金額' , order_discount '折扣' , order_logistics_fee '運費' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders where $orderSearchBar = $searchKey ; " ;
        $pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

		echo "<table>
		<tr class='cyan'><th width='80px'>訂單編號</th><th width='100px'>會員編號</th><th width='100px'>收件人</th><th width='200px'>聯絡電話</th><th width=80px'>訂單狀態</th><th width=110px'>運送方式</th><th width=200px'>收件地址</th></tr>
		<tr class='cyan'><th></th><th width=80px'>付款方式</th><th width=80px'>原始金額</th><th width=50px'>折扣</th><th width=50px'>運費</th><th width=80px'>付款金額</th><th width=110px'>訂單成立時間</th></tr>";
		
		foreach ( $prodRows as $i => $prodRow){
			echo "
			<tr>
			<td class='pink'>".$prodRow['訂單編號']."</td>
			<td>".$prodRow['會員編號']."</td>
			<td>".$prodRow['收件人']."</td>
			<td>".$prodRow['聯絡電話']."</td>
			<td>".$prodRow['訂單狀態']."</td>
			<td>".$prodRow['運送方式']."</td>
			<td>".$prodRow['收件地址']."</td>
		   </tr>
			<tr>
			<td></td>
			<td>".$prodRow['付款方式']."</td>
			<td>".$prodRow['原始金額']."</td>
			<td>".$prodRow['折扣']."</td>
			<td>".$prodRow['運費']."</td>
			<td>".$prodRow['付款金額']."</td>
			<td>".$prodRow['訂單成立時間']."</td>
		   </tr>
		   ";
		}
		echo "</table>";

		$sql = "SELECT product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價'  from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no where orders.{$_POST['orderSearchBar']} = {$_POST['searchKey']}; " ;
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

		echo "<table>
		<tr class='cyan'><th width='110px'>商品預覽</th><th width='110px'>商品編號</th><th width='200px'>商品名稱</th><th width='80px'>難度等級</th><th width='80px'>購買數量</th><th width='80px'>商品單價</th></tr>";

		foreach ( $prodRows as $i => $prodRow){
			echo "<tr>
			<td class='pink'><img src='".$prodRow["商品預覽"]."' width='110px' alt=''></td>
			<td>".$prodRow["商品編號"]."</td>
			<td>".$prodRow["商品名稱"]."</td>
			<td>".$prodRow["難度等級"]."</td>
			<td>".$prodRow["購買數量"]."</td>
			<td>".$prodRow["商品單價"]."</td>
		   </tr>";
		}
		echo "</table>";
	}	catch	(PDOException $e)	{
	}
}
?>