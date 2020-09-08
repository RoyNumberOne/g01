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