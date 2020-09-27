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
            <div class="verify_total">
                <h4>審核嚮導證</h4>
                    <span id="loadButton_1"style="background-color:#2C5E9E; color:#FFF">未處理</span>
                    <span id="loadButton_2">已通過</span>
                    <span id="loadButton_3">未通過</span>
            </div>
            <div id="ccc">
                <h3>嚮導審核 - 未處理</h3>
                    <?php 
                    try	{
                        require_once('connectMeetain.php');
                        
                            $sql = "SELECT member_guide_no 'no' ,  mem_no '會員編號' , guide_image '證件照片' , guide_no '嚮導證編號' , guide_period_start '發證日期' , guide_period_end '有效日期' , mem_guide_apply '申請時間'  FROM member_guide where mem_guide_situation = '未審核' order by mem_guide_apply ;";
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <table>
                            <tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width=110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="150px">申請狀態</th><th>確認</th></tr>
                            <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?>
                                <tr>
                                <td class='pink'><?=$prodRow["no"]?></td>
                                <td><?=$prodRow["會員編號"]?></td>
                                <td><img src="<?=$prodRow["證件照片"]?>" width="220px" alt=""></td>
                                <td><?=$prodRow["嚮導證編號"]?></td>
                                <td><?=$prodRow["發證日期"]?></td>
                                <td><?=$prodRow["有效日期"]?></td>
                                <td><?=$prodRow["申請時間"]?></td>
                                <td style="text-align: left;padding-left: 10px;">
                                    <label><input type="radio" value="已審核已通過" name="VERIFYguide<?=$prodRow["no"]?>">通過</label><br>
                                    <label><input type="radio" value="已審核未通過" name="VERIFYguide<?=$prodRow["no"]?>">未通過</label>
                                </td>
                                <td><label><input name="<?=$prodRow["no"]?>" type="button" value="送出" disabled class="sendverifyguide"></label></td>
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
$('input[name^="VERIFYguide"]').change(function(){
    $(this).parent().parent().next().children().children().removeAttr("disabled");
});
</script>

<script>
	// 實名制認證 － 結果送出
	$(Document).ready(function(){
		$(".sendverifyguide").click(function(){

			var temp = $(this).attr('name');
			let VERIFYguideIfPass = $("input[name='VERIFYguide"+temp+"']:checked").val();
			
			// console.log(temp);
			// console.log(VERIFYguideIfPass);

				$.ajax({
					url: './BackstageVERIFYguide.php',
					data: {	member_guide_no: temp,
							VERIFYguideIfPass: VERIFYguideIfPass ,
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
// =====button class="btnA_S" 的頁碼切換=====
$(document).ready(function(){
//load php
    $('#loadButton_1').click(function () {
        $('#ccc').load('BackstageMemGuide_4.php');
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_3').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
    $('#loadButton_2').click(function () {
        $('#ccc').load('BackstageMemGuide_2.php', { name_2: '已審核已通過' });
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_3').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
    $('#loadButton_3').click(function () {
        $('#ccc').load('BackstageMemGuide_3.php', { name_3: '已審核未通過' });
        $(this).css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
});

</script>
<script src="./js/backstage.js"></script>
</body>
</html>