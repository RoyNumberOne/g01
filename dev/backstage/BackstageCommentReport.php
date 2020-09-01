<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/Backstagereport.css">
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
            <div class="report_total"> 
                <h4>留言檢舉</h4>
                <span style="background-color:#2C5E9E; color:#FFF" id="loadButton_1">未處理</span>
                <span id="loadButton_2">已處理</span>
                <span id="loadButton_3">未通過</span>
            </div>
            <div id="ccc">
                <h3>留言檢舉 - 未處理</h3>
                    <?php 
                        try	{
                        require_once('connectMeetain.php');
                        
                            $sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "未處理" ;';
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <table>
                            <tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">留言編號</th><th width="300px">留言內文</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></tr>
                            <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?>
                                <tr>
                                <td class='pink'><?=$prodRow["檢舉編號"]?></td>
                                <td><?=$prodRow["留言編號"]?></td>
                                <td style="text-align: left;padding-left: 5px;"><?=$prodRow["留言內文"]?></td>
                                <td><?=$prodRow["被檢舉人"]?></td>
                                <td><?=$prodRow["檢舉時間"]?></td>
                                <td style="text-align: left;padding-left: 5px;"><?=$prodRow["檢舉緣由"]?></td>
                                <td style="text-align: left;padding-left: 5px;">   <label><input type="radio" value="unPass" name="review?<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                                        <label><input type="radio" value="Pass" name="review?<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                                        <select name="BanLong">
                                            <option value="5">5分鐘</option>
                                            <option value="3" selected="selected">3天</option>
                                            <option value="7">7天</option>
                                            <option value="14">14天</option>
                                            <option value="28">28天</option>
                                        </select>
                                </td>
                                <td style="background-color: #eaf1f4;" ><button type="submit" class="btnB_L_yellow">
                                    <p>送出</p>
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

//load php
    $('#loadButton_1').click(function () {
        $('#ccc').load('BackstageCommentReport_4.php',{ name_4: '未處理' });
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_3').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
    $('#loadButton_2').click(function () {
        $('#ccc').load('BackstageCommentReport_2.php', { name_2: '已處理已通過' });
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_3').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
    $('#loadButton_3').click(function () {
        $('#ccc').load('BackstageCommentReport_3.php', { name_3: '已處理未通過' });
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });


});

</script>
<script src="./js/backstage.js"></script>
</body>
</html>