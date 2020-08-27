<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/Backstagemain.css">
    <link rel="stylesheet" href="../css/BackstageHeader.css">
    <link rel="stylesheet" href="../css/Backstageproduct.css">
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
        <nav id="BackstageNav">
            <ul class="page index"><a href="./BackstageIndex.php">
                    <p class="title">首頁</p>
                </a></ul>
            <ul class="report">
                <p class="title">檢舉</p>
                <li class="page navli tour"><a href="./BackstageTourReport.php">
                        <p class="desc">揪團</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
                <li class="page navli forum"><a href="./BackstageForumReport.php">
                        <p class="desc">討論</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                        foreach($pdo->query('SELECT COUNT(*) FROM forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "未處理"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
                <li class="page navli comment"><a href="./BackstageCommentReport.php">
                        <p class="desc">留言</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM comment_report cr JOIN comment_post cp ON cr.comment_report_comment = cp.comment_no WHERE cr.comment_report_situation = "未處理"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
            </ul>
            <ul class="verify">
                <p class="title">審核</p>
                <li class="page navli realname"><a href="./BackstageMemRealname.php">
                        <p class="desc">實名制</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM member_realname where mem_realname_situation = "未審核"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
                <li class="page navli guide"><a href="./BackstageMemGuide.php">
                        <p class="desc">嚮導</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM member_guide where mem_guide_situation = "未審核"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
            </ul>
            <ul class="page product"><a href="./BackstageProduct.php">
                    <p class="title" style="color:#1A95DB;">商品</p>
                </a></ul>
            <ul class="page administer"><a href="./BackstageAdministrator.php">
                    <p class="title">管理員</p>
                </a></ul>
        </nav>
    </aside>
    <section>
        <div>
            <div class="product_total">
                <h4>商品管理</h4>
                    <span style="background-color:#2C5E9E; color:#FFF">上架中</span>
                    <span>未上架</span>
                    <button type="submit" class="btnB_L_yellow_2"><p>新增</p><div class="bg2"></div></button>
            </div>
                <?php 
                    try	{
                        require_once('connectMeetain.php');
                        
                            $sql = 'SELECT product_no "商品編號" , degree_category "難度等級" , product_category "商品分類" , product_name "商品名稱" , product_price "商品價格" , product_description "商品說明" , product_image1 "商品圖片一" , product_image2 "商品圖片二" , product_image3 "商品圖片三" from product where product_situation = 1; ';
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <table>
                            <tr class='cyan'><th width="80px">商品編號</th><th width="100px">難度等級</th><th width="100px">商品分類</th><th width="160px">商品名稱</th><th width="80px">商品價格</th><th width="300px">商品說明</th><th width="100px">商品圖片一</th><th width="100px">商品圖片二</th><th width="100px">商品圖片三</th></tr>
                            <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?>
                                <tr>
                                <td class='pink'><?=$prodRow["商品編號"]?></td>
                                <td><?=$prodRow["難度等級"]?></td>
                                <td><?=$prodRow["商品分類"]?></td>
                                <td><?=$prodRow["商品名稱"]?></td>
                                <td><?=$prodRow["商品價格"]?></td>
                                <td style="overflow:hidden;
                                            white-space: nowrap;
                                            text-overflow: ellipsis;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                            white-space: normal;">
                                            <?=$prodRow["商品說明"]?></td>
                                <td><?=$prodRow["商品圖片一"]?></td>
                                <td><?=$prodRow["商品圖片二"]?></td>
                                <td><?=$prodRow["商品圖片三"]?></td>
                                <td style="background-color: #eaf1f4;" ><button type="submit" class="btnB_L_yellow">
                                <p>修改</p>
                                <div class="bg"></div>
                                </button></td>
                                </tr>

                                <?php } ?>
                            </table>
                        <?php
                        }	catch	(PDOException $e)	{
                        }
                    ?>
        </div>
        <div class="pagebtn">
            <button class="btnA_S pgprev"><p style="transform: translate(-5px , 0px); transition: 0s;">&#10229</p></button>
            <button class="btnA_S pg -active"><p>01</p></button>
            <button class="btnA_S pg"><p>02</p></button>
            <button class="btnA_S pg"><p>03</p></button>
            <button class="btnA_S pg"><p>04</p></button>
            <button class="btnA_S pg"><p>05</p></button>
            <button class="btnA_S pgnext"><p style="transform: translate(-5px , 0px); transition: 0s;">&#10230</p></button>
        </div>
    </section>
</main>
<script>
// =====button class="btnA_S" 的頁碼切換=====
$(document).ready(function(){
    function checkpg(){
    if ($(".pgprev").next().hasClass("-active")) {
        $(".pgprev").css("visibility","hidden");
    }   else {
        $(".pgprev").css("visibility","visible");
    }
    if ($(".pgnext").prev().hasClass("-active")) {
        $(".pgnext").css("visibility","hidden");
    }   else{
        $(".pgnext").css("visibility","visible");
    }
}
checkpg();
$(".pg").click(function(){
    $(this).parent().children().removeClass("-active");
    $(this).addClass("-active");
    checkpg();
});
$(".pgprev").click(function(){
    if (!$(".pgprev").next().hasClass("-active")) {
        $(".-active").prev().addClass("-active");
        $(".-active").next(".-active").removeClass("-active");
    }
    checkpg();
});
$(".pgnext").click(function(){
    if (!$(".pgnext").prev().hasClass("-active")) {
        $(".-active").next().addClass("-active");
        $(".-active").prev(".-active").removeClass("-active");
    }
    checkpg();
});
// =====button class="btnA_S" 的頁碼切換=====
});

</script>
<script src="./js/backstage.js"></script>
</body>
</html>