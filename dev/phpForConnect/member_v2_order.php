<script src="../js/jquery-3.5.1.js"></script>
<?php
session_start();
try	{
    require_once('connectMeetain.php');

    $memNO = $_SESSION["mem_no"] ;

    if(isset($_SESSION["mem_no"]) === true){
        $sql = "SELECT order_no '訂單編號' , member_no '會員編號' ,order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_cashflow '付款方式' , order_position '訂單狀態' , order_total '付款金額' , order_build '訂單成立時間' from orders join member on orders.member_no = member.mem_no where member_no = $memNO order by order_no; " ;
        $pdoStatement = $pdo->query($sql);
        $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <form method="post" id="clickOrderNo">
            <table>
                <thead class="forRWD">
                    <tr class='cyan'><th>訂單編號</th><th>會員編號</th><th>收件人</th><th width="110px">聯絡電話</th><th>付款方式</th><th>訂單狀態</th><th>付款金額</th><th>訂單成立時間</th></tr>
                </thead>
            <?php
                foreach ( $prodRows as $i => $prodRow){
            ?>
                <tbody>
                    <tr class="forRWD_tr">
                        <td class="showDetail forRWD_td" data-th="訂單編號" style="padding-top:5px;">
                            <?=$prodRow["訂單編號"]?>
                        </td>
                        <td data-th="會員編號" class="forRWD_td"><?=$prodRow["會員編號"]?></td>
                        <td data-th="收件人" class="forRWD_td"><?=$prodRow["收件人"]?></td>
                        <td data-th="聯絡電話" class="forRWD_td"><?=$prodRow["聯絡電話"]?></td>
                        <td data-th="付款方式" class="forRWD_td"><?=$prodRow["付款方式"]?></td>
                        <td data-th="訂單狀態" class="forRWD_td"><?=$prodRow["訂單狀態"]?></td>
                        <td data-th="付款金額" class="forRWD_td"><?=$prodRow["付款金額"]?></td>
                        <td data-th="訂單成立時間" class="forRWD_td" style="padding-bottom:5px;"><?=$prodRow["訂單成立時間"]?></td>
                    </tr>
                </tbody>
            <?php } ?>
        </form>

        <div id="showMoreDetail"></div>
    <script>
// 點擊得到訂單詳情
        $(Document).ready(function(){

            $(".showDetail").click(function(e){
                e.preventDefault();
                let ordNo = $(e.target).text();
                    $.ajax({
                        url: './phpForConnect/member_v2_orderDetail.php',
                        data:  {ordNo : ordNo},
                        type: "POST",
                        success: function(data){
                            $("#showMoreDetail").html(data);
                        },
                        error: function(){
                            console.log('error');
                        },
                    });

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