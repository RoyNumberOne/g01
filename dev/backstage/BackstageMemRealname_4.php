<h3>審核實名制 - 未審核</h3>
<?php 
try	{
    require_once('connectMeetain.php');
	
		$sql = "SELECT member_realname_no 'no' ,  mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間'  FROM member_realname where mem_realname_situation = '未審核' order by mem_realname_apply ;";
		$pdoStatement = $pdo->query($sql);
		$prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table>
		<tr class='cyan'><th width="30px">no.</th><th width="80px">會員編號</th><th width="220px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="110px">申請狀態</th><th>確認</th></tr>
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
             <td style="text-align: left;padding-left: 10px;">   
			 	<label><input type="radio" value="已審核已通過" name="VERIFYname<?=$prodRow["no"]?>">通過</label><br>
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
			
			// console.log(temp);
			// console.log(VERIFYnameIfPass);

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