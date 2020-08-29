<h3>討論檢舉 - 未處理</h3>
<?php 
$name_4=$_REQUEST["name_4"];
try	{
    require_once('connectMeetain.php');
		$sql = "SELECT forum_report_no '檢舉編號' , forum_report_post '討論編號' , forum_post_title '討論標題' , forum_post_poster '被檢舉人' , forum_report_build '檢舉時間', forum_report_reason '檢舉緣由' from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = '$name_4' ;";
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
                <td style="text-align: left;padding-left: 10px;"><?=$prodRow["討論標題"]?></td>
                <td><?=$prodRow["被檢舉人"]?></td>
                <td><?=$prodRow["檢舉時間"]?></td>
                <td><?=$prodRow["檢舉緣由"]?></td>
                <td style="text-align: left;padding-left: 10px;">   <label><input type="radio" value="unPass" name="review?<?=$prodRow["檢舉編號"]?>">未通過</label><br>
                        <label><input type="radio" value="Pass" name="review?<?=$prodRow["檢舉編號"]?>">通過，禁言</label>
                        <select name="BanLong">
                            <option value="5">5分鐘</option>
                            <option value="3" selected="selected">3天</option>
                            <option value="7">7天</option>
                            <option value="14">14天</option>
                            <option value="28">28天</option>
                        </select>
                </td>
                <td style="background-color: #eaf1f4;" ><button type="submit" class="btnB_L_yellow">
                    <p>送出</p>
                    <div class="bg"></div>
                </button></td>
            </tr>

			<?php } ?>
		</table>
	<?php
	}	catch	(PDOException $e)	{
	}
?>