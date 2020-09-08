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
                <span id="loadButton_2">已通過</span>
                <span id="loadButton_3">未通過</span>
            </div>
            <div id="ccc">
                <h3>審核實名制 - 未審核</h3>
                <?php 
                try	{
                    require_once('connectMeetain.php');
                    
                        $sql = "SELECT member_realname_no 'no' ,  mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間'  FROM member_realname where mem_realname_situation = '未審核' order by mem_realname_apply ;";
                        $pdoStatement = $pdo->query($sql);
                        $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table>
                        <tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="220px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="110px">申請狀態</th><th width="80px"></th></tr>
                        <?php
                        foreach ( $prodRows as $i => $prodRow){
                        ?>
                            <tr>
                            <td class='pink'><?=$prodRow["no"]?></td>
                            <td><?=$prodRow["會員編號"]?></td>
                            <td><img src="<?=$prodRow["證件照片"]?>" width="220px" alt=""></td>
                            <td><?=$prodRow["身分證字號"]?></td>
                            <td><?=$prodRow["真實姓名"]?></td>
                            <td><?=$prodRow["申請時間"]?></td>
                            <td>   <label><input type="radio" value="已審核已通過" name="VERIFYname<?=$prodRow["no"]?>">通過</label><br>
                                    <label><input type="radio" value="已審核未通過" name="VERIFYname<?=$prodRow["no"]?>">未通過</label>
                            </td>
                            <td><label><input name="<?=$prodRow["no"]?>" type="button" value="送出" disabled class="sendverifyname"></label></td>
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
            <!-- <button></button> -->
        </div>
    </section>
</main>
<script>
// 有選結果才能打開送出button
$('input[name^="VERIFYname"]').change(function(){
    $(this).parent().parent().next().children().children().removeAttr("disabled");
});
</script>

<script>
	// 實名制認證 － 結果送出
$(Document).ready(function(){
    $(".sendverifyname").click(function(){

        var temp = $(this).attr('name');
        let VERIFYnameIfPass = $("input[name='VERIFYname"+temp+"']:checked").val();
        
        console.log(temp);
        console.log(VERIFYnameIfPass);

            $.ajax({
                url: './BackstageVERIFYname.php',
                data: {	member_realname_no: temp,
                        VERIFYnameIfPass: VERIFYnameIfPass ,
                    },
                type: 'POST',   
                success(){
                } ,
            });


        $(this).prop('disabled', 'disabled');
        $(this).parent().parent().prev().children().prop("disabled","disabled");
        $(this).parent().parent().prev().children().children().prop("disabled","disabled");
    })
})
 </script>
<script>
$(document).ready(function () {
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