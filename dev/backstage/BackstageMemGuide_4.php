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
});
 </script>