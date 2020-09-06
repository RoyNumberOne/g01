<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MySQL</title>
    <script src="./js/jquery-3.5.1.js"></script>
    <style type="text/css">
	* {
        position: relative;
        font-family: 微軟正黑體;
        /* letter-spacing: 5px; */
		line-height: 25px;
		box-sizing: border-box;
		outline: none;
    }
	body {
		background-color: #bbb;
	}
	.center {
		margin-left: 40%;
	}
	p {
		font-size: 16px ;
		color:  #2C90A6 ;
	}
    h3 {
        margin: 20px auto;
        text-align: center;
    }
	table {
		border: 1px solid black;
		border-collapse:collapse;
		margin-left: 50%;
		/* margin-top: 15%; */
		transform: translateX(-50%);
		background-color: #eee;
	}
	th {
        padding: 3px 3px;
        text-align: center;
	}
	td {
		border: 1px solid black;
        padding: 3px 10px;
	}
    tr {
        height: 40px !important;
    }
	.pink{
		background-color: pink;
		text-align: center;
	}
	.cyan{
		background-color: cyan;
	}

	form#newProduct {
		display: flex;
		flex-wrap: wrap ;
		width: 720px;
		border: 1px solid cyan;
		margin: 0 auto;
	}
	form#newProduct div.block{
		display: inline-block;
		width: 50%;
		padding: 20px;
	}
	form#newProduct div.block div.itembox{
		margin-bottom: 20px;
	}
	form#newProduct button#newProductBtnSend{
		margin: 10px auto;
	}
	form#newAdministrator {
		width: 720px;
		border: 1px solid cyan;
		margin: 0 auto;
		display: flex;
		flex-direction: column;
	}
	form#newAdministrator div.block{
		display: block;
		width: 50%;
		margin: 0 auto;
		padding: 20px;
	}
	form#newAdministrator div.block div.itembox{
		margin-bottom: 20px;
	}
	form#newAdministrator button#newAdministratorBtnSend{
		display: block;
		margin: 10px auto;
	}
</style>

</head>
<body>

<h3>揪團檢舉 - 未處理</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	// $status = '未處理';
		$sql = "SELECT tour_report_no '檢舉編號' , tour_report_tour '揪團編號' , tour_title '揪團標題' , tour_hoster '被檢舉人' , tour_report_build '檢舉時間', tour_report_reason '檢舉緣由' from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = '未處理';";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">揪團編號</th><th width="300px">揪團標題</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th><th width="80px"></th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["揪團編號"]?></td>
             <td><?=$prodRow["揪團標題"]?></td>
             <td><input type="text" name="REVIEWtrMember<?=$prodRow["檢舉編號"]?>" readonly value="<?=$prodRow["被檢舉人"]?>"></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>   <label><input type="radio" value="已處理未通過" name="REVIEWtr<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                    <label><input type="radio" value="已處理已通過" name="REVIEWtr<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                    <select name="BANLONGtr<?=$prodRow["檢舉編號"]?>">
                        <option value="5">5分鐘</option>
                        <option value="4320" selected="selected">3天</option>
                        <option value="10080">7天</option>
                        <option value="20160"">14天</option>
                        <option value="40320">28天</option>
                    </select>
            </td>
			<td><label><input name="<?=$prodRow["檢舉編號"]?>" type="button" value="送出" disabled class="sendtourreport"></label></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<script>
// 有選結果才能打開送出button
$('input[name^="REVIEWtr"]').change(function(){
    $(this).parent().parent().next().children().children().removeAttr("disabled");
});
</script>

<script>
	// 揪團檢舉 － 結果送出
	$(Document).ready(function(){
		$(".sendtourreport").click(function(){

			var temp = $(this).attr('name');
			let REVIEWtrIfPass = $("input[name='REVIEWtr"+temp+"']:checked").val();
			let REVIEWtrBanLong = $("select[name='BANLONGtr"+temp+"']").val();
			let REVIEWtrMember = $("input[name='REVIEWtrMember"+temp+"']").val();
			
			console.log(temp);
			console.log(REVIEWtrIfPass);
			console.log(REVIEWtrBanLong);
			console.log(REVIEWtrMember);

			// if (REVIEWtrBanLong)

			if ( REVIEWtrIfPass == '已處理未通過'){
				console.log ('已處理未通過')

				$.ajax({
					url: './BackstageREVIEWtrUnPass.php',
					data: {	tour_report_no: temp,
							REVIEWtrIfPass: REVIEWtrIfPass ,
						},
					type: 'POST',   
					success(){
					} ,
				});

			}	else	{
				console.log ('已處理已通過')

				$.ajax({
					url: './BackstageREVIEWtrPass.php',
					data: {	tour_report_no: temp,
							REVIEWtrIfPass: REVIEWtrIfPass ,
							REVIEWtrBanLong: REVIEWtrBanLong,
							REVIEWtrMember: REVIEWtrMember,
						},
					type: 'POST',   
					success(){
						console.log('ya')
					} ,
				});

			}
			$(this).prop('disabled', 'disabled');
			$(this).parent().parent().prev().children().prop("disabled","disabled");
			$(this).parent().parent().prev().children().children().prop("disabled","disabled");
		})
	})
 </script>


<h3>揪團檢舉 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由", tour_report_banLong "檢舉時長", mem.ban_tour_date "解封時間" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no join member mem on tour_hoster = mem.mem_no where tr.tour_report_situation = "已處理已通過" order by tour_report_build ; ';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">揪團編號</th><th width="300px">揪團標題</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["揪團編號"]?></td>
             <td><?=$prodRow["揪團標題"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>禁言<?=$prodRow["檢舉時長"]?><br><?=$prodRow["解封時間"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>揪團檢舉 - 已處理未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
		$sql = 'SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由",tour_report_situation "檢舉狀態" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "已處理未通過" order by tour_report_build ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">揪團編號</th><th width="300px">揪團標題</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["揪團編號"]?></td>
             <td><?=$prodRow["揪團標題"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td><?=$prodRow["檢舉狀態"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<h3>討論檢舉 - 未處理</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "未處理" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">討論編號</th><th width="300px">討論標題</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th><th width="80px"></th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["討論編號"]?></td>
             <td><?=$prodRow["討論標題"]?></td>
             <td><input type="text" name="REVIEWfrMember<?=$prodRow["檢舉編號"]?>" readonly value="<?=$prodRow["被檢舉人"]?>"></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>   <label><input type="radio" value="已處理未通過" name="REVIEWfr<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                    <label><input type="radio" value="已處理已通過" name="REVIEWfr<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                    <select name="BANLONGfr<?=$prodRow["檢舉編號"]?>">
                        <option value="5">5分鐘</option>
                        <option value="4320" selected="selected">3天</option>
                        <option value="10080">7天</option>
                        <option value="20160"">14天</option>
                        <option value="40320">28天</option>
                    </select>
			</td>
			<td><label><input name="<?=$prodRow["檢舉編號"]?>" type="button" value="送出" disabled class="sendforumreport"></label></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<script>
// 有選結果才能打開送出button
$('input[name^="REVIEWfr"]').change(function(){
    $(this).parent().parent().next().children().children().removeAttr("disabled");
});
</script>


<script>
	// 揪團檢舉 － 結果送出
	$(Document).ready(function(){
		$(".sendforumreport").click(function(){

			var temp = $(this).attr('name');
			let REVIEWfrIfPass = $("input[name='REVIEWfr"+temp+"']:checked").val();
			let REVIEWfrBanLong = $("select[name='BANLONGfr"+temp+"']").val();
			let REVIEWfrMember = $("input[name='REVIEWfrMember"+temp+"']").val();
			
			console.log(temp);
			console.log(REVIEWfrIfPass);
			console.log(REVIEWfrBanLong);
			console.log(REVIEWfrMember);

			// if (REVIEWfrBanLong)

			if ( REVIEWfrIfPass == '已處理未通過'){
				console.log ('已處理未通過')

				$.ajax({
					url: './BackstageREVIEWfrUnPass.php',
					data: {	forum_report_no: temp,
							REVIEWfrIfPass: REVIEWfrIfPass ,
						},
					type: 'POST',   
					success(){
					} ,
				});

			}	else	{
				console.log ('已處理已通過')

				$.ajax({
					url: './BackstageREVIEWfrPass.php',
					data: {	forum_report_no: temp,
							REVIEWfrIfPass: REVIEWfrIfPass ,
							REVIEWfrBanLong: REVIEWfrBanLong,
							REVIEWfrMember: REVIEWfrMember,
						},
					type: 'POST',   
					success(){
						console.log('ya')
					} ,
				});

			}
			$(this).prop('disabled', 'disabled');
			$(this).parent().parent().prev().children().prop("disabled","disabled");
			$(this).parent().parent().prev().children().children().prop("disabled","disabled");
		})
	})
 </script>


<h3>討論檢舉 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由", forum_report_banLong "檢舉時長", mem.ban_forum_date "解封時間" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no join member mem on forum_post_poster = mem.mem_no where fr.forum_report_situation = "已處理已通過" order by forum_report_build ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">討論編號</th><th width="300px">討論標題</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["討論編號"]?></td>
             <td><?=$prodRow["討論標題"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>禁言<?=$prodRow["檢舉時長"]?><br><?=$prodRow["解封時間"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>討論檢舉 - 已處理未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由", forum_report_situation "檢舉狀態" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "已處理未通過"  order by forum_report_build ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">討論編號</th><th width="300px">討論標題</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["討論編號"]?></td>
             <td><?=$prodRow["討論標題"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td><?=$prodRow["檢舉狀態"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>留言檢舉 - 未處理</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT comment_report_no '檢舉編號' , comment_report_comment '留言編號' , comment_innertext '留言內文' , comment_poster '被檢舉人' , comment_report_build '檢舉時間', comment_report_reason '檢舉緣由' , comment_class '檢舉板塊' from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = '未處理' ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">留言編號</th><th width="300px">留言內文</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="110px">檢舉板塊</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></th><th width="80px"></th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["檢舉編號"]?></td>
             <td><?=$prodRow["留言編號"]?></td>
             <td><?=$prodRow["留言內文"]?></td>
             <td><input type="text" name="REVIEWcrMember<?=$prodRow["檢舉編號"]?>" readonly value="<?=$prodRow["被檢舉人"]?>"></td>
			 <td><?=$prodRow["檢舉時間"]?></td>
			 <td><input type="text" name="REVIEWcrClass<?=$prodRow["檢舉編號"]?>" readonly value="<?=$prodRow["檢舉板塊"]?>"></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>   <label><input type="radio" value="已處理未通過" name="REVIEWcr<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                    <label><input type="radio" value="已處理已通過" name="REVIEWcr<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                    <select name="BANLONGcr<?=$prodRow["檢舉編號"]?>">
                        <option value="5">5分鐘</option>
                        <option value="4320" selected="selected">3天</option>
                        <option value="10080">7天</option>
                        <option value="20160"">14天</option>
                        <option value="40320">28天</option>
                    </select>
			</td>
			<td><label><input name="<?=$prodRow["檢舉編號"]?>" type="button" value="送出" disabled class="sendcommentreport"></label></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<script>
// 有選結果才能打開送出button
$('input[name^="REVIEWcr"]').change(function(){
    $(this).parent().parent().next().children().children().removeAttr("disabled");
});
</script>


<script>
	// 揪團檢舉 － 結果送出
	$(Document).ready(function(){
		$(".sendcommentreport").click(function(){

			var temp = $(this).attr('name');
			let REVIEWcrClass = $("input[name='REVIEWcrClass"+temp+"']").val();
			let REVIEWcrIfPass = $("input[name='REVIEWcr"+temp+"']:checked").val();
			let REVIEWcrBanLong = $("select[name='BANLONGcr"+temp+"']").val();
			let REVIEWcrMember = $("input[name='REVIEWcrMember"+temp+"']").val();
			
			console.log(temp);
			console.log(REVIEWcrClass)
			console.log(REVIEWcrIfPass);
			console.log(REVIEWcrBanLong);
			console.log(REVIEWcrMember);

			// if (REVIEWcrBanLong)

			if ( REVIEWcrIfPass == '已處理未通過'){
				console.log ('已處理未通過')

				$.ajax({
					url: './BackstageREVIEWcrUnPass.php',
					data: {	comment_report_no: temp,
							REVIEWcrIfPass: REVIEWcrIfPass ,
						},
					type: 'POST',   
					success(){
					} ,
				});

			}	else	{
				console.log ('已處理已通過')

				$.ajax({
					url: './BackstageREVIEWcrPass.php',
					data: {	comment_report_no: temp,
							REVIEWcrClass: REVIEWcrClass ,
							REVIEWcrIfPass: REVIEWcrIfPass ,
							REVIEWcrBanLong: REVIEWcrBanLong,
							REVIEWcrMember: REVIEWcrMember,
						},
					type: 'POST',   
					success(){
						console.log('ya')
					} ,
				});

			}
			$(this).prop('disabled', 'disabled');
			$(this).parent().parent().prev().children().prop("disabled","disabled");
			$(this).parent().parent().prev().children().children().prop("disabled","disabled");
		})
	})
 </script>



<h3>留言檢舉 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_banLong "檢舉時長", ban_forum_date "討論區解封時間", ban_tour_date "揪團解封時間" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no join member mem on comment_report_mem = mem.mem_no where cr.comment_report_situation = "已處理已通過" order by comment_report_build ;  ;';
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
             <td><?=$prodRow["留言內文"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>禁言<?=$prodRow["檢舉時長"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>留言檢舉 - 已處理未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_situation "檢舉狀態" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "已處理未通過" order by comment_report_build ;';
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
             <td><?=$prodRow["留言內文"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td><?=$prodRow["檢舉狀態"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<h3>實名制審核 - 未審核</h3>
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

<h3>實名制審核 - 已審核已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT member_realname_no 'no' ,  mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間' , mem_realname_verify '審核時間'  FROM member_realname where mem_realname_situation = '已審核已通過' order by  mem_realname_verify desc ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="150px">審核時間</th></tr>
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
             <td><?=$prodRow["審核時間"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>實名制審核 - 已審核未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT member_realname_no 'no' ,  mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間' , mem_realname_verify '審核時間'  FROM member_realname where mem_realname_situation = '已審核未通過' order by  mem_realname_verify desc ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="150px">審核時間</th></tr>
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
             <td><?=$prodRow["審核時間"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<h3>嚮導審核 - 未審核</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT member_guide_no 'no' ,  mem_no '會員編號' , guide_image '證件照片' , guide_no '嚮導證編號' , guide_period_start '發證日期' , guide_period_end '有效日期' , mem_guide_apply '申請時間'  FROM member_guide where mem_guide_situation = '未審核' order by mem_guide_apply ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width=110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="150px">申請狀態</th><th width="80px"></th></tr>
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
			<td><label><input type="radio" value="已審核已通過" name="VERIFYguide<?=$prodRow["no"]?>">通過</label><br>
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
			
			console.log(temp);
			console.log(VERIFYguideIfPass);

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



<h3>嚮導審核 - 已審核已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT member_guide_no 'no' , mem_no '會員編號' , guide_image '證件照片' , guide_no '嚮導證編號' , guide_period_start '發證日期' , guide_period_end '有效日期' , mem_guide_apply '申請時間' , mem_guide_verify '審核時間'  FROM member_guide where mem_guide_situation = '已審核已通過' order by mem_guide_verify desc ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width="110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="110px">審核時間</th></tr>
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
             <td><?=$prodRow["審核時間"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<h3>嚮導審核 - 已審核未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT member_guide_no 'no' , mem_no '會員編號' , guide_image '證件照片' , guide_no '嚮導證編號' , guide_period_start '發證日期' , guide_period_end '有效日期' , mem_guide_apply '申請時間' , mem_guide_verify '審核時間'  FROM member_guide where mem_guide_situation = '已審核未通過' order by mem_guide_verify desc ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width="110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="110px">審核時間</th></tr>
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
             <td><?=$prodRow["審核時間"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>


<h3>商品 - 上架中</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT product_no '商品編號' , degree_category '難度等級' , product_category '商品分類' , product_name '商品名稱' , product_price '商品價格' , product_description '商品說明' , product_image1 '商品圖片一' , product_image2 '商品圖片二' , product_image3 '商品圖片三' , product_situation '商品狀態' from product where product_situation = 1; ";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">商品編號</th><th width="100px">難度等級</th><th width="100px">商品分類</th><th width="160px">商品名稱</th><th width="80px">商品價格</th><th width="300px">商品說明</th><th width="100px">商品圖片一</th><th width="100px">商品圖片二</th><th width="100px">商品圖片三</th><th width="80px">修改</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["商品編號"]?>
				<input type="checkbox" name="productAUTH<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品狀態"]?>'>
			</td>
             <td><?=$prodRow["難度等級"]?></td>
             <td><?=$prodRow["商品分類"]?></td>
             <td><input type="text" name="productNAME<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品名稱"]?>'></td>
             <td><input type="text" name="productPRICE<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品價格"]?>'></td>
             <td><input type="text" name="productDESC<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品說明"]?>'></td>
             <td><img src="<?=$prodRow["商品圖片一"]?>" width="100px" alt=""></td>
             <td><img src="<?=$prodRow["商品圖片二"]?>" width="100px" alt=""></td>
             <td><img src="<?=$prodRow["商品圖片三"]?>" width="100px" alt=""></td>
			<td><label><input name="<?=$prodRow["商品編號"]?>" type="button" value="修改" class="editproduct"></label></td>
            </tr>

			<script>
				function checkProductAuth(){
					if ( <?=$prodRow["商品狀態"]?> == 1 ){
						$("input[name='productAUTH<?=$prodRow["商品編號"]?>'").prop("checked","checked");
					}
				}
					checkProductAuth();
			</script>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<script>
// checkbox 切換更動 value
$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
});
</script>

<script>
	// 商品修改 － 上架中
	$(Document).ready(function(){
		$(".editproduct").click(function(){
			if ($(this).val() == '修改'){
				$(this).prop('value', '儲存');
				$(this).parent().parent().siblings().children().removeAttr("disabled");
			}	else	{
				var temp = $(this).attr('name');
				let EDITproduct_name = $("input[name='productNAME"+temp+"']").val();
				let EDITproduct_price = $("input[name='productPRICE"+temp+"']").val();
				let EDITproduct_description = $("input[name='productDESC"+temp+"']").val();
				let EDITproduct_situation = $("input[name='productAUTH"+temp+"']").val();
				
				// console.log(EDITproduct_situation);
				$.ajax({
					url: './BackstageEditProduct.php',
					data: {	product_no: temp,
							EDITproduct_name: EDITproduct_name ,
							EDITproduct_price:EDITproduct_price,
							EDITproduct_description:EDITproduct_description,
							EDITproduct_situation:EDITproduct_situation
						},
					type: 'POST',   
					success(){
					} ,
				});

				$(this).prop('value', '修改');
				$(this).parent().parent().siblings().children().prop("disabled","disabled");
			}
		})
	})
</script>

<h3>商品 - 未上架</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT product_no '商品編號' , degree_category '難度等級' , product_category '商品分類' , product_name '商品名稱' , product_price '商品價格' , product_description '商品說明' , product_image1 '商品圖片一' , product_image2 '商品圖片二' , product_image3 '商品圖片三' , product_situation '商品狀態'  from product where product_situation = 0; ";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">商品編號</th><th width="100px">難度等級</th><th width="100px">商品分類</th><th width="160px">商品名稱</th><th width="80px">商品價格</th><th width="300px">商品說明</th><th width="100px">商品圖片一</th><th width="100px">商品圖片二</th><th width="100px">商品圖片三</th><th width="80px">修改</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["商品編號"]?>
				<input type="checkbox" name="productAUTH<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品狀態"]?>'>
			</td>
             <td><?=$prodRow["難度等級"]?></td>
             <td><?=$prodRow["商品分類"]?></td>
             <td><input type="text" name="productNAME<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品名稱"]?>'></td>
             <td><input type="text" name="productPRICE<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品價格"]?>'></td>
             <td><input type="text" name="productDESC<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品說明"]?>'></td>
             <td><img src="<?=$prodRow["商品圖片一"]?>" width="100px" alt=""></td>
             <td><img src="<?=$prodRow["商品圖片二"]?>" width="100px" alt=""></td>
             <td><img src="<?=$prodRow["商品圖片三"]?>" width="100px" alt=""></td>
			 <td><label><input name="<?=$prodRow["商品編號"]?>" type="button" value="修改" class="editproduct"></label></td>
            </tr>

		<script>
			function checkProductAuth(){
				if ( <?=$prodRow["商品狀態"]?> == 1 ){
					$("input[name='productAUTH<?=$prodRow["商品編號"]?>'").prop("checked","checked");
				}
			}
				checkProductAuth();
		</script>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<script>
// checkbox 切換更動 value
$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
});
</script>

<!-- <script>
	// 商品修改 － 未上架
	$(Document).ready(function(){
		$(".editproduct").click(function(){
			if ($(this).val() == '修改'){
				$(this).prop('value', '儲存');
				$(this).parent().parent().siblings().children().removeAttr("disabled");
			}	else	{
				var temp = $(this).attr('name');
				let EDITproduct_name = $("input[name='productNAME"+temp+"']").val();
				let EDITproduct_price = $("input[name='productPRICE"+temp+"']").val();
				let EDITproduct_description = $("input[name='productDESC"+temp+"']").val();
				let EDITproduct_situation = $("input[name='productAUTH"+temp+"']").val();
				
				console.log(EDITproduct_situation);
				$.ajax({
					url: './BackstageEditProduct.php',
					data: {	product_no: temp,
							EDITproduct_name: EDITproduct_name ,
							EDITproduct_price:EDITproduct_price,
							EDITproduct_description:EDITproduct_description,
							EDITproduct_situation:EDITproduct_situation
						},
					type: 'POST',   
					success(){
					} ,
				});

				$(this).prop('value', '修改');
				$(this).parent().parent().siblings().children().prop("disabled","disabled");
			}
		})
	})
</script> -->

<h3>商品 - 新增</h3>
<form id="newProduct" method="post"  enctype="multipart/form-data"  action="backstageAddProduct.php" >
	<div class="block left">
		<div class="itembox">商品名稱：<input id="product_name" name="product_name" type="text"></div>
		<div class="itembox">商品類別：
			<select id="product_category" name="product_category">
				<option value="機能服飾">機能服飾</option>
				<option value="登山背包">登山背包</option>
				<option value="登山鞋">登山鞋</option>
				<option value="露營裝備">露營裝備</option>
				<option value="登山配件">登山配件</option>
			</select></div>
		<div class="itembox">難度等級：
					<label><input class="degree_category" type="radio" value="1" name="degree_category">1</label>
					<label><input class="degree_category" type="radio" value="2" name="degree_category">2</label>
					<label><input class="degree_category" type="radio" value="3" name="degree_category">3</label>
					<label><input class="degree_category" type="radio" value="4" name="degree_category">4</label>
		</div>
		<div class="itembox">商品價格：<input id="product_price" name="product_price" type="text"></div>
		<div class="itembox">商品說明：<input id="product_description" name="product_description" type="text"></div>
	</div>
	<div class="block right">
		<div class="itembox">商品圖片<input type="file" name="upFile[]" multiple accept="image/*" id="product_image"></div>
		<div class="productUploadImage">
			<div class="imgPreview1"><img width="200px" name="product_image1" id="product_image1" src="" alt=""></div>
			<div class="imgPreview2"><img width="200px" name="product_image2" id="product_image2" src="" alt=""></div>
			<div class="imgPreview3"><img width="200px" name="product_image3" id="product_image3" src="" alt=""></div>
		</div>
		<div class="itembox">上架狀態：
			<label><input class="product_situation" type="radio" value="1" name="product_situation">直接上架</label>
			<label><input class="product_situation" type="radio" value="0" name="product_situation">先不要上架</label>
		</div>
	</div>
	<button type="button" id="newProductBtnSend">送出</button>
</form>

<script>
	// 商品 - 新增
	$(Document).ready(function(){
		$("#newProductBtnSend").click(function(e){

			e.preventDefault();

			// let product_name = $("#product_name").val();
			// let product_category = $("#product_category").val();
			// let degree_category = $(".degree_category:checked").val();
			// let product_price = $("#product_price").val();
			// let product_description = $("#product_description").val();
			// let product_img1 = $_FILES["upFile"]["error"][0];
			// let product_img2 = $_FILES["upFile"]["error"][1];
			// let product_img3 = $_FILES["upFile"]["error"][2];
			// let product_situation = $(".product_situation:checked").val();
			



				$.ajax({
					url: './BackstageAddProduct.php',
					type: "POST",
					data:  new FormData(document.getElementById("newProduct")),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						// $("#targetLayer").html(data);
					},
					error: function(){
					},
				});
		})
	})
</script>
 <!-- 上傳商品圖預覽  -->
<script>
    $("#product_image").change(function(){
        $("div.productUploadImage div").html(""); // 清除預覽
        console.log ( this.files.length );
        if(this.files.length !== 3) {
            alert('請上傳三張照片');
        }   else {
            readURL(this);
        }
    });

    function readURL(input){
        if (input.files && input.files.length >= 0) {
            for(var i = 0; i < input.files.length; i ++){
                let t;
                t = i + 1;
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $("<img>").attr({src : e.target.result , id : "productImg" + i , width : "200px"});
                    $(".imgPreview"+t).append(img);

                }
                reader.readAsDataURL(input.files[i]);
            }
        }else{
            var noPictures = $("<p>目前尚未上傳圖片</p>");
            $(".imgPreview").append(noPictures);
        }
    }
</script>




<h3>管理員</h3>
	<form id="AUTHADMIN">
		<!-- <label><input type="checkbox" name="ADMINtype" value="0" class="center" id="byeAdministrator" onclick="type_admin();"> -->
		<label><input type="checkbox" name="ADMINtype1" value="1" class="center" id="byeAdministrator" onchange="this.form.submit();">
		顯示已停權之管理員</label>
	</form>

	<script>
	// checkbox 切換更動 value
	// $(Document).ready(function ADMINtype(){
		function type_admin(){
			// $("input#byeAdministrator").change(function(){
				this.value = (Number(this.checked));
				console.log(123);
				// $('#AUTHADMIN').submit();
				console.log(23);
			// })
		}
	// });
	</script>


<?php 
try	{
    require_once('connectMeetain.php');
	
		if (isset($_REQUEST['ADMINtype1'])===true){
			$sql = "SELECT admin_no '管理員編號'  , admin_name '姓名' , admin_id '暱稱' , admin_mail '電子信箱' , admin_build '建立時間' , admin_authority '管理員權限' from  administrator where admin_authority >= 0  ; " ;
		}	else {
			$sql = "SELECT admin_no '管理員編號'  , admin_name '姓名' , admin_id '暱稱' , admin_mail '電子信箱' , admin_build '建立時間' , admin_authority '管理員權限' from  administrator where admin_authority >= 1  ; " ;
		}
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
					<input type="checkbox" name="adminAUTH<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["管理員權限"]?>'>
				</td>
				<td><input type="text" name="adminNAME<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["姓名"]?>'></td>
				<td><input type="text" name="adminID<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["暱稱"]?>'></td>
				<td><input type="text" name="adminMAIL<?=$prodRow["管理員編號"]?>" disabled value='<?=$prodRow["電子信箱"]?>'></td>
				<td><?=$prodRow["建立時間"]?></td>
				<td><label><input name="<?=$prodRow["管理員編號"]?>" type="button" value="修改" class="editadmin"></label></td>
            </tr>

			<script>
				function checkAdminAuth(){
					// console.log(<?=$prodRow["管理員編號"]?>);
					// console.log(<?=$prodRow["管理員權限"]?>);
					if ( <?=$prodRow["管理員權限"]?> == 1 ){
						$("input[name='adminAUTH<?=$prodRow["管理員編號"]?>'").prop("checked","checked");

					}
				}
					checkAdminAuth();
			</script>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

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
				var temp = $(this).attr('name');
				let EDITadmin_name = $("input[name='adminNAME"+temp+"']").val();
				let EDITadmin_id = $("input[name='adminID"+temp+"']").val();
				let EDITadmin_mail = $("input[name='adminMAIL"+temp+"']").val();
				let EDITadmin_authority = $("input[name='adminAUTH"+temp+"']").val();
				
				// console.log(EDITadmin_authority);
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
	})
</script>

<h3>管理員 - 新增</h3>
<form id="newAdministrator" method="post" action="./BackstageAddAdministrator.php" >
	<div class="block">
		<div class="itembox">暱稱：<input id="admin_id" name="admin_id" type="text"></div>
		<div class="itembox">姓名：<input id="admin_name" name="admin_name" type="text"></div>
		<div class="itembox">帳號：<input id="admin_acc" name="admin_acc" type="text"></div>
		<div class="itembox">密碼：<input id="admin_psw" name="admin_psw" type="password"></div><label><input class="itembox" type="checkbox" id="pswCheck">顯示密碼</label>
		<div class="itembox">信箱：<input id="admin_mail" name="admin_mail" type="text"></div>
	</div>
	<button type="button" id="newAdministratorBtnSend">送出</button>
</form>


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
		});
	})
</script>

<h3>近期訂單</h3>
<form id="searchOrder" method="post" action="./BackstageShowOrderDetail2.php">
	<select width="200px" id="orderSearchBar" name="orderSearchBar">
		<option value="order_no" selected="selected">依訂單編號</option>
		<option value="member_no">依會員編號</option>
		<option value="order_logistics_phone">聯絡電話</option>
	</select>
	<label><input type="text" id="searchKey" name="searchKey"></label>
	<button type="submit" id="searchOrderBtnSend">查詢</button>
</form>


<script>
	// 訂單詳情
	$(Document).ready(function(){
		$("#searchOrderBtnSend").click(function(e){
			e.preventDefault();
				$.ajax({
					url: './BackstageShowOrderDetail2.php',
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
		})
	})
</script>

<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT order_no '訂單編號' , member_no '會員編號' , order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_cashflow '付款方式' , order_position '訂單狀態' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders order by order_no limit 6; " ;
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>

		<table>
		<tr class='cyan'><th width="80px">訂單編號</th><th width="80px">會員編號</th><th width="80px">收件人</th><th width="110px">聯絡電話</th><th width="80px">付款方式</th><th width=80px">訂單狀態</th><th width=80px">付款金額</th><th width=110px">訂單成立時間</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["訂單編號"]?></td>
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
	<?php
	}	catch	(PDOException $e)	{
	}
?>


<h3>訂單詳情</h3>
<div id="ShowSearchOrder"></div>







</body>
</html>