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
                <button type="button" class="btnB_L_yellow_2" id="loadButton"><p>新增</p><div class="bg2"></div></button>
            </div>
            <div id="ccc2">
				
				<form id="newAdministrator" method="post" action="./BackstageAddAdministrator.php" >
					<h3>新增管理員</h3>
						<div class="block" id="addadmin">
						<div class="itembox">暱稱：<input id="admin_id" name="admin_id" type="text"></div>
						<div class="itembox">姓名：<input id="admin_name" name="admin_name" type="text"></div>
						<div class="itembox">帳號：<input id="admin_acc" name="admin_acc" type="text"></div>
						<div class="itembox" id="admin_psw1">密碼：<input id="admin_psw" name="admin_psw" type="password">
							<input class="itembox" type="checkbox" id="pswCheck">
							<label for="pswCheck"><img src="../images/icons/icon_Invisible.svg" alt="" width=30 height=30 id="eye"></label>
						</div>
						<div class="itembox">信箱：<input id="admin_mail" name="admin_mail" type="text"></div>
						<div id="btnB22"><button type="button" class="btnB2" id="newAdministratorBtnSend"><p>送出</p><div class="bg2"></div></button></div>
					</div>	
				</form>
            </div>
        </div>
    </section>
</main>
<script>
// checkbox 切換更動 value
$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
});
</script>
<script>
	// 管理員 - 新增
	$(Document).ready(function(){
		$("#newAdministratorBtnSend").click(function(){
			let admin_id = $("#admin_id").val();
			let admin_name = $("#admin_name").val();
			let admin_acc = $("#admin_acc").val();
			let admin_psw = $("#admin_psw").val();
			let admin_mail = $("#admin_mail").val();
			$.post("./BackstageAddAdministrator.php",
				{admin_id: admin_id,
				admin_name: admin_name,
				admin_acc: admin_acc,
				admin_psw: admin_psw,
				admin_mail: admin_mail,
				},
				function(){
				//要導去另外正確頁面
				window.location.reload(true);
			})
		})
		$('#pswCheck').click(function(){
                $(this).is(':checked') ? $('#admin_psw').attr('type', 'text') : $('#admin_psw').attr('type', 'password');
        		if($("#eye").attr('src') === "../images/icons/icon_Invisible.svg"){
            	$("#eye").attr("src","../images/icons/icon_visibility.svg");
        		}else{
           		 $("#eye").attr("src","../images/icons/icon_Invisible.svg");
        		}
    		});
	});
</script>
<script src="./js/backstage.js"></script>
</body>
</html>