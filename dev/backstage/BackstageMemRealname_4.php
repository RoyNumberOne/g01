<?php 
    $name_4 = $_REQUEST["name_4"];
    try	{
        require_once('connectMeetain.php');
        
            $sql = "SELECT mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間'  FROM member_realname where mem_realname_situation = '$name_4' order by '申請時間' ;";
            // exit($sql);
            $pdoStatement = $pdo->query($sql);
            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            ?>
<table>
    <tr class='cyan'>
        <th width="80px">會員編號</th>
        <th width="300px">證件照片</th>
        <th width="140px">身分證字號</th>
        <th width="80px">真實姓名</th>
        <th width="110px">申請時間</th>
        <th width="150px">申請狀態</th>
    </tr>
    <?php
            foreach ( $prodRows as $i => $prodRow){
            ?>
    <tr>
        <td class='pink'><?=$prodRow["會員編號"]?></td>
        <td><?=$prodRow["證件照片"]?></td>
        <td><?=$prodRow["身分證字號"]?></td>
        <td><?=$prodRow["真實姓名"]?></td>
        <td><?=$prodRow["申請時間"]?></td>
        <td style="text-align: left;padding-left: 5px;"> <label><input type="radio" value="Pass"
                    name="review?<?=$prodRow["會員編號"]?>">通過</label><br>
            <label><input type="radio" value="unPass" name="review?<?=$prodRow["會員編號"]?>">未通過</label> </td>
        <td style="background-color: #eaf1f4;"><button type="submit" class="btnB_L_yellow">
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