<h3>留言檢舉 - 已處理已通過</h3>
<?php 
$name_2=$_REQUEST["name_2"];
try	{
    require_once('connectMeetain.php');
		$sql = "SELECT comment_report_no '檢舉編號' , comment_report_comment '留言編號' , comment_innertext '留言內文' , comment_poster '被檢舉人' , comment_report_build '檢舉時間', comment_report_reason '檢舉緣由' , comment_class '檢舉板塊' , comment_report_banLong '檢舉時長', ban_forum_date '討論區解封時間', ban_tour_date '揪團解封時間' from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no join member mem on comment_report_mem = mem.mem_no where cr.comment_report_situation = '$name_2' ;";
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