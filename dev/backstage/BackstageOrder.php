<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/BackstageOrder.css">
    <link rel="stylesheet" href="../css/BackstageHeader.css">
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/fa5.14.0all.js"integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="crossorigin="anonymous"></script>
</head>
<body>
<main>
    <?php
    require_once("./BackstageHeader.inc");
    ?>
    <aside>
    <?php
        require_once("./BackstageNav.inc");
    ?>        
    </aside>
    <section>
        <div>
            <div class="order_detail"> 
                <h3>訂單查詢</h3>
                <form id="searchOrder" method="post" action="./BackstageShowOrderDetail.php">
                    <label><input type='hidden' readonly width="200px" id="orderSearchBar" name="orderSearchBar" value="order_no" class="copy_inp">訂單編號：</label>
                    <label><input type="text" id="searchKey" name="searchKey" minlength="6" maxlength="6" placeholder="請輸入6位編號"></label>
                    <button type="submit" class="btnB_L_yellow_2" id="searchOrderBtnSend"><p>查詢</p><div class="bg2"></div></button>
                </form>
            </div>
            <hr>
            <div class="ShowSearchOrder">
                <div id="ShowSearchOrder"></div>   
            </div>
            <div id="ccc">
            <h3>最新10筆訂單</h3>
                <?php 
                try	{
                    require_once('connectMeetain.php');
                    
                        $sql = "SELECT order_no '訂單編號' , member_no '會員編號' , order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_cashflow '付款方式' , order_position '訂單狀態' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders order by order_no limit 10; " ;
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
                    }	catch	(PDOException $e)	{
                    }
                ?>
            </div>
        </div>
    </section>
</main>
<script>
$(Document).ready(function(){
    let url = new URL(window.location.href);
    // console.log(url);
    let curPage = new URLSearchParams(url.search);
    curPage = curPage.get("pageNo") - 1;
    // console.log(curPage);
    if (curPage == -1) { curPage = 0}
    // console.log(curPage);
    $(".pagebtn").children().eq(curPage).children().addClass('-active')
});
</script>
 <script>
	// 訂單詳情
$(Document).ready(function(){
    $("#searchOrderBtnSend").click(function(e){
        e.preventDefault();
            $.ajax({
                url: './BackstageShowOrderDetail.php',
                type: "POST",
                data:  new FormData(document.getElementById("searchOrder")),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    $("#ShowSearchOrder").html(data);
                },
                error: function(){
                },
            });
    });
});
</script>
<script src="./js/backstage.js"></script>
</body>
</html>