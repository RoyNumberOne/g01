<h3>揪團檢舉 - 未處理</h3>
<?php 
$name_4=$_REQUEST["name_4"];
try	{
    require_once('connectMeetain.php');
		$sql = "SELECT tour_report_no '檢舉編號' , tour_report_tour '揪團編號' , tour_title '揪團標題' , tour_hoster '被檢舉人' , tour_report_build '檢舉時間', tour_report_reason '檢舉緣由',tour_report_situation '檢舉狀態' from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = '$name_4' ;";
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
    <td style="text-align: left;padding-left: 5px;"><?=$prodRow["揪團標題"]?></td>
    <td ><?=$prodRow["被檢舉人"]?></td>
    <td><?=$prodRow["檢舉時間"]?></td>
    <td style="text-align: left;padding-left: 5px;"><?=$prodRow["檢舉緣由"]?></td>
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