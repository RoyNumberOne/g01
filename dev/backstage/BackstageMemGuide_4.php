<h3>嚮導審核 - 未處理</h3>
<?php 
$name_4=$_REQUEST["name_4"];
try	{
    require_once('connectMeetain.php');
    
    $sql = "SELECT mem_no '會員編號' , guide_image '證件照片' , guide_no '嚮導證編號' , guide_period_start '發證日期' , guide_period_end '有效日期' , mem_guide_apply '申請時間'  FROM member_guide where mem_guide_situation = '$name_4' order by '審核時間' ;";
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
        <td style="text-align: left;padding-left: 5px;">   <label><input type="radio" value="Pass" name="review?<?=$prodRow["會員編號"]?>">通過</label><br>
                <label><input type="radio" value="unPass" name="review?<?=$prodRow["會員編號"]?>">未通過</label> </td>
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