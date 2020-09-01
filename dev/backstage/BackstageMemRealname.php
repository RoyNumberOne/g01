<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/Backstageverify.css">
    <link rel="stylesheet" href="../css/BackstageHeader.css">
    <link rel="stylesheet" href="./css/verify.css">
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/fa5.14.0all.js"
        integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="
        crossorigin="anonymous"></script>
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
            <div class="verify_total">
                <h4>審核實名制</h4>
                <span id="loadButton_1" style="background-color:#2C5E9E; color:#FFF">未處理</span>
                <span id="loadButton_2">已處理</span>
                <span id="loadButton_3">未通過</span>
            </div>
            <div id="ccc">
                <?php 
                    try	{
                        require_once('connectMeetain.php');
                        
                            $sql = "SELECT mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間'  FROM member_realname where mem_realname_situation = '未審核' order by '申請時間' ;";
                            // exit($sql);
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                <table>
                    <tr class='cyan'>
                        <th width="80px">會員編號</th>
                        <th width="300px">證件照片</th>
                        <th width="140px">身分證字號</th>
                        <th width="80px">真實姓名</th>
                        <th width="110px">申請時間</th>
                        <th width="150px">申請狀態</th>
                    </tr>
                    <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?>
                    <tr>
                        <td class='pink'><?=$prodRow["會員編號"]?></td>
                        <td><?=$prodRow["證件照片"]?></td>
                        <td><?=$prodRow["身分證字號"]?></td>
                        <td><?=$prodRow["真實姓名"]?></td>
                        <td><?=$prodRow["申請時間"]?></td>
                        <td style="text-align: left;padding-left: 5px;"> <label><input type="radio" value="Pass"
                                    name="review?<?=$prodRow["會員編號"]?>">通過</label><br>
                            <label><input type="radio" value="unPass" name="review?<?=$prodRow["會員編號"]?>">未通過</label> </td>
                        <td style="background-color: #eaf1f4;"><button type="submit" class="btnB_L_yellow">
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
$(document).ready(function () {
    function checkpg() {
        if ($(".pgprev").next().hasClass("-active")) {
            $(".pgprev").css("visibility", "hidden");
        } else {
            $(".pgprev").css("visibility", "visible");
        }
        if ($(".pgnext").prev().hasClass("-active")) {
            $(".pgnext").css("visibility", "hidden");
        } else {
            $(".pgnext").css("visibility", "visible");
        }
    }
    checkpg();
    $(".pg").click(function () {
        $(this).parent().children().removeClass("-active");
        $(this).addClass("-active");
        checkpg();
    });
    $(".pgprev").click(function () {
        if (!$(".pgprev").next().hasClass("-active")) {
            $(".-active").prev().addClass("-active");
            $(".-active").next(".-active").removeClass("-active");
        }
        checkpg();
    });
    $(".pgnext").click(function () {
        if (!$(".pgnext").prev().hasClass("-active")) {
            $(".-active").next().addClass("-active");
            $(".-active").prev(".-active").removeClass("-active");
        }
        checkpg();
    });
    // =====button class="btnA_S" 的頁碼切換=====

    $('#loadButton_1').click(function () {
        $('#ccc').load('BackstageMemRealname_4.php', { name_4: '未審核' });
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_3').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
        $('#loadButton_2').click(function () {
            $('#ccc').load('BackstageMemRealname_2.php', { name_2: '已審核未通過' });
            $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
            $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
            $('#loadButton_3').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        });
        $('#loadButton_3').click(function () {
            $('#ccc').load('BackstageMemRealname_3.php', { name_3: '已處理未通過' });
            $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
            $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
            $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        });
    });

</script>
<script src="./js/backstage.js"></script>
</body>

</html>