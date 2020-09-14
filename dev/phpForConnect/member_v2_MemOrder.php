<?php 
try	{
    require_once('connectMeetain.php');           
    $sql = "SELECT order_no '訂單編號' , order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_cashflow '付款方式' , order_position '訂單狀態' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders order by order_no limit 10; " ;
    $pdoStatement = $pdo->query($sql);
    $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
?>
    <table>
    <tr class='cyan'><th>訂單編號</th><th>會員編號</th><th>收件人</th><th width="110px">聯絡電話</th><th>付款方式</th><th>訂單狀態</th><th>付款金額</th><th>訂單成立時間</th></tr>
    <?php
    foreach ( $prodRows as $i => $prodRow){
    ?>
    <tr>
    <td><?=$prodRow["訂單編號"]?></td>
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
    }catch	(PDOException $e){
    }
?>