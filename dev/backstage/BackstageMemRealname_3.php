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