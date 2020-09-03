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
    <link rel="stylesheet" href="../css/BackstageAdministrator.css">
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
            <div class="Administrator">
                <a href="BackstageAdministrator.php"><h4>管理員</h4></a>
                <a href="BackstageAddAdmin.php"><button type="button" class="btnB_L_yellow_2" id="loadButton"><p>新增管理員</p><div class="bg2"></div></button></a>
            </div>
            <div id="ccc">
                <label><input type="checkbox" class="center" id="byeAdministrator">顯示已停權之管理員</label>
                    <?php 
                    try	{
                        require_once('connectMeetain.php');
                        
                            $sql = "SELECT admin_no '管理員編號'  , admin_name '姓名' , admin_id '暱稱' , admin_mail '電子信箱' , admin_build '建立時間' , admin_authority '管理員權限' from  administrator where admin_authority >= 0  ; " ;
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <table>
                            <tr class='cyan'><th width="80px">管理員編號</th><th width="100px">姓名</th><th width="100px">暱稱</th><th width="200px">電子信箱</th><th width=110px">建立時間</th><th width=80px">修改</th></tr>
                            <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?>
                                <tr>
                                    <td class='pink'><?=$prodRow["管理員編號"]?>
                                        <input type="checkbox" name="adminAUTH<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["管理員權限"]?>' />
                                    </td>
                                    <td><input type="text" name="adminNAME<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["姓名"]?>'></td>
                                    <td><input type="text" name="adminID<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["暱稱"]?>'></td>
                                    <td><input type="text" name="adminMAIL<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["電子信箱"]?>'></td>
                                    <td><?=$prodRow["建立時間"]?></td>
                                    <td><label><input name="<?=$prodRow["管理員編號"]?>" type="button" value="修改" class="editadmin"></label></td>
                                </tr>

                                <?php } ?>
                            </table>
                        <?php
                        }	catch	(PDOException $e)	{
                        }
                    ?>
            </div>
        </div>
    </section>
</main>
<script>
    function checkAdminAuth(){
        console.log(<?=$prodRow["管理員編號"]?>);
        console.log(<?=$prodRow["管理員權限"]?>);
        if ( <?=$prodRow["管理員權限"]?> == 1 ){
            $("input name='adminAUTH<?=$prodRow["管理員編號"]?>'").prop("checked","checked");
        }
    }
        checkAdminAuth();
</script>
<script>
// checkbox 切換更動 value
$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
});
</script>
<script>
	// 管理員 － 修改
	$(Document).ready(function(){
		$(".editadmin").click(function(){
			if ($(this).val() == '修改'){
				$(this).prop('value', '儲存');
				$(this).parent().parent().siblings().children().removeAttr("disabled");
			}	else	{
				let temp = $(this).attr('name');
				let EDITadmin_name = $("input[name='adminNAME"+temp+"']").val();
				let EDITadmin_id = $("input[name='adminID"+temp+"']").val();
				let EDITadmin_mail = $("input[name='adminMAIL"+temp+"']").val();
				let EDITadmin_authority = $("input[name='adminAUTH"+temp+"']").val();
				
				console.log(EDITadmin_authority);
				$.ajax({
					url: './BackstageEditAdministrator.php',
					data: {	admin_no: temp,
							EDITadmin_name: EDITadmin_name ,
							EDITadmin_id:EDITadmin_id,
							EDITadmin_mail:EDITadmin_mail,
							EDITadmin_authority:EDITadmin_authority
						},
					type: 'POST',   
					success(){
					} ,
				});

				$(this).prop('value', '修改');
				$(this).parent().parent().siblings().children().prop("disabled","disabled");
			}
		})
	});
</script>
<script src="./js/backstage.js"></script>
</body>
</html>