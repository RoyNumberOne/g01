<?php 
    $name_2 = $_REQUEST["name_2"];
    try	{
        require_once('connectMeetain.php');
        
            $sql = "SELECT mem_no '會員編號' , mem_idno_image '證件照片' , mem_idno '身分證字號' , mem_realname '真實姓名' , mem_realname_apply '申請時間'  FROM member_realname where mem_realname_situation = '$name_2' order by '申請時間' ;";
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
