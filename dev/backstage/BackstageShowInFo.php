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
</style>

</head>
<body>

<h3>揪團檢舉 - 未處理</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	// $status = '未處理';
		$sql = 'SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理";';
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
             <td>   <label><input type="radio" value="unPass" name="review?<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                    <label><input type="radio" value="Pass" name="review?<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                    <select name="BanLong">
                        <option value="5">5分鐘</option>
                        <option value="3" selected="selected">3天</option>
                        <option value="7">7天</option>
                        <option value="14">14天</option>
                        <option value="28">28天</option>
                    </select>
            </td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>揪團檢舉 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由", tour_report_banLong "檢舉時長", ban_tour_date "解封時間" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no join member mem on tour_report_mem = mem.mem_no where tr.tour_report_situation = "已處理已通過" ;';
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
		$sql = 'SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由",tour_report_situation "檢舉狀態" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "已處理未通過" ;';
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
             <td>   <label><input type="radio" value="unPass" name="review?<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                    <label><input type="radio" value="Pass" name="review?<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                    <select name="BanLong">
                        <option value="5">5分鐘</option>
                        <option value="3" selected="selected">3天</option>
                        <option value="7">7天</option>
                        <option value="14">14天</option>
                        <option value="28">28天</option>
                    </select>
            </td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>討論檢舉 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由", forum_report_banLong "檢舉時長", ban_forum_date "解封時間" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no join member mem on forum_report_mem = mem.mem_no where fr.forum_report_situation = "已處理已通過" ;';
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
	
		$sql = 'SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由", forum_report_situation "檢舉狀態" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "已處理未通過" ;';
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
             <td><?=$prodRow["留言內文"]?></td>
             <td><?=$prodRow["被檢舉人"]?></td>
             <td><?=$prodRow["檢舉時間"]?></td>
             <td><?=$prodRow["檢舉緣由"]?></td>
             <td>   <label><input type="radio" value="unPass" name="review?<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                    <label><input type="radio" value="Pass" name="review?<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                    <select name="BanLong">
                        <option value="5">5分鐘</option>
                        <option value="3" selected="selected">3天</option>
                        <option value="7">7天</option>
                        <option value="14">14天</option>
                        <option value="28">28天</option>
                    </select>
            </td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>留言檢舉 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_banLong "檢舉時長", ban_forum_date "討論區解封時間", ban_tour_date "揪團解封時間" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no join member mem on comment_report_mem = mem.mem_no where cr.comment_report_situation = "已處理已通過" ;';
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
             <td>禁言<?=$prodRow["檢舉時長"]?><br><?=$prodRow["解封時間"]?></td>
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
	
		$sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_situation "檢舉狀態" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "已處理未通過" ;';
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

<h3>實名制審核 - 未處理</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間"  FROM member_realname where mem_realname_situation = "未審核" order by "申請時間" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="150px">申請狀態</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["會員編號"]?></td>
             <td><?=$prodRow["證件照片"]?></td>
             <td><?=$prodRow["身分證字號"]?></td>
             <td><?=$prodRow["真實姓名"]?></td>
             <td><?=$prodRow["申請時間"]?></td>
             <td>   <label><input type="radio" value="Pass" name="review?<?=$prodRow["會員編號"]?>">通過</label><br>
                    <label><input type="radio" value="unPass" name="review?<?=$prodRow["會員編號"]?>">未通過</label> </td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>實名制審核 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間" , mem_realname_verify "審核時間"  FROM member_realname where mem_realname_situation = "已審核未通過" order by "審核時間" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="150px">審核時間</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["會員編號"]?></td>
             <td><?=$prodRow["證件照片"]?></td>
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
<h3>實名制審核 - 已處理未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間" , mem_realname_verify "審核時間"  FROM member_realname where mem_realname_situation = "已審核未通過" order by "審核時間" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="150px">審核時間</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["會員編號"]?></td>
             <td><?=$prodRow["證件照片"]?></td>
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

<h3>嚮導審核 - 未處理</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT mem_no "會員編號" , guide_image "證件照片" , guide_no "嚮導證編號" , guide_period_start "發證日期" , guide_period_end "有效日期" , mem_guide_apply "申請時間"  FROM member_guide where mem_guide_situation = "未審核" order by "審核時間" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width=110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="150px">申請狀態</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
             <td class='pink'><?=$prodRow["會員編號"]?></td>
             <td><?=$prodRow["證件照片"]?></td>
             <td><?=$prodRow["嚮導證編號"]?></td>
             <td><?=$prodRow["發證日期"]?></td>
             <td><?=$prodRow["有效日期"]?></td>
             <td><?=$prodRow["申請時間"]?></td>
             <td>   <label><input type="radio" value="Pass" name="review?<?=$prodRow["會員編號"]?>">通過</label><br>
                    <label><input type="radio" value="unPass" name="review?<?=$prodRow["會員編號"]?>">未通過</label> </td>
            </tr>
		
			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<h3>實名制審核 - 已處理已通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT mem_no "會員編號" , guide_image "證件照片" , guide_no "嚮導證編號" , guide_period_start "發證日期" , guide_period_end "有效日期" , mem_guide_apply "申請時間" , mem_guide_verify "審核時間"  FROM member_guide where mem_guide_situation = "已審核已通過" order by "審核時間" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width="110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="110px">審核時間</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
			 <td class='pink'><?=$prodRow["會員編號"]?></td>
             <td><?=$prodRow["證件照片"]?></td>
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

<h3>實名制審核 - 已處理未通過</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT mem_no "會員編號" , guide_image "證件照片" , guide_no "嚮導證編號" , guide_period_start "發證日期" , guide_period_end "有效日期" , mem_guide_apply "申請時間" , mem_guide_verify "審核時間"  FROM member_guide where mem_guide_situation = "已審核未通過" order by "審核時間" ;';
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">嚮導證編號</th><th width="110px">發證日期</th><th width="110px">有效日期</th><th width="110px">申請時間</th><th width="110px">審核時間</th></tr>
		<?php
		foreach ( $prodRows as $i => $prodRow){
		?>
			 <tr>
			 <td class='pink'><?=$prodRow["會員編號"]?></td>
             <td><?=$prodRow["證件照片"]?></td>
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
             <td><?=$prodRow["商品說明"]?></td>
             <td><?=$prodRow["商品圖片一"]?></td>
             <td><?=$prodRow["商品圖片二"]?></td>
             <td><?=$prodRow["商品圖片三"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>
<h3>商品 - 未上架</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = 'SELECT product_no "商品編號" , degree_category "難度等級" , product_category "商品分類" , product_name "商品名稱" , product_price "商品價格" , product_description "商品說明" , product_image1 "商品圖片一" , product_image2 "商品圖片二" , product_image3 "商品圖片三" from product where product_situation = 0; ';
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
             <td><?=$prodRow["商品說明"]?></td>
             <td><?=$prodRow["商品圖片一"]?></td>
             <td><?=$prodRow["商品圖片二"]?></td>
             <td><?=$prodRow["商品圖片三"]?></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>

<h3>商品 - 新增</h3>
<form id="newProduct" method="post" action="backstageAddProduct.php" >
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
		<div class="itembox">商品圖片：<input id="product_image1" name="product_image1" type="file"></div>
		<div class="itembox">商品圖片：<input id="product_image2" name="product_image2" type="file"></div>
		<div class="itembox">商品圖片：<input id="product_image3" name="product_image3" type="file"></div>
		<div class="itembox">上架狀態：
			<label><input class="product_situation" type="radio" value="1" name="product_situation">直接上架</label>
			<label><input class="product_situation" type="radio" value="0" name="product_situation">先不要上架</label>
		</div>
	</div>
	<button type="button" id="newProductBtnSend">送出</button>
</form>
	<!-- <div id="newProductFeedback">2222</div> -->

</body>

<script>
	// 商品 - 新增
	$(Document).ready(function(){
		$("#newProductBtnSend").click(function(){
			let product_name = $("#product_name").val();
			let product_category = $("#product_category").val();
			let degree_category = $(".degree_category:checked").val();
			let product_price = $("#product_price").val();
			let product_description = $("#product_description").val();
			let product_image1 = $("#product_image1").val();
			let product_image2 = $("#product_image2").val();
			let product_image3 = $("#product_image3").val();
			let product_situation = $(".product_situation:checked").val();
			$.post("./backstageAddProduct.php",
				{product_name: product_name,
				product_category: product_category,
				degree_category: degree_category,
				product_price: product_price,
				product_description: product_description,
				product_image1: product_image1,
				product_image2: product_image2,
				product_image3: product_image3,
				product_situation: product_situation
				},
				function(){
				//要導去另外正確頁面
				window.location.reload(true);
			})
		})
	})
</script>

</html>