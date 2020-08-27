<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/Backstageverify.css">
    <link rel="stylesheet" href="../css/BackstageHeader.css">
    <link rel="stylesheet" href="./css/verify.css">
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/fa5.14.0all.js"integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="crossorigin="anonymous"></script>
</head>
<body>
<main>
    <?php
        require_once("./BackstageHeader.inc");
    ?>
    <aside>
        <nav id="BackstageNav">
            <ul class="page index"><a href="./BackstageIndex.php">
                    <p class="title">首頁</p>
                </a></ul>
            <ul class="report">
                <p class="title">檢舉</p>
                <li class="page navli tour"><a href="./BackstageTourReport.php">
                        <p class="desc">揪團</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
                <li class="page navli forum"><a href="./BackstageForumReport.php">
                        <p class="desc">討論</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                        foreach($pdo->query('SELECT COUNT(*) FROM forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "未處理"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
                <li class="page navli comment"><a href="./BackstageCommentReport.php">
                        <p class="desc">留言</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM comment_report cr JOIN comment_post cp ON cr.comment_report_comment = cp.comment_no WHERE cr.comment_report_situation = "未處理"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
            </ul>
            <ul class="verify">
                <p class="title" style="color:#1A95DB;">審核</p>
                <li class="page navli realname"><a href="./BackstageMemRealname.php">
                        <p class="desc">實名制</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM member_realname where mem_realname_situation = "未審核"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
                <li class="page navli guide"><a href="./BackstageMemGuide.php">
                        <p class="desc">嚮導</p>
                        <div class="note">
                            <p>
                                <?php 
                                try	{
                                    require_once('connectMeetain.php');
                                    if($pdo != false){
                                            foreach($pdo->query('SELECT COUNT(*) FROM member_guide where mem_guide_situation = "未審核"') as $row) {
                                            echo $row['COUNT(*)'];
                                            }

                                    }	else	{
                                        echo "<br>失敗ㄌ<br>";
                                    }
                                }	catch	(PDOException $e)	{
                                    echo "錯誤原因：",$e->getMessage(), "<br>";
                                    echo "錯誤行號：",$e->getLine(),"<br>";
                                }
                                ?>
                            </p>
                        </div>
                    </a></li>
            </ul>
            <ul class="page product"><a href="./BackstageProduct.php">
                    <p class="title">商品</p>
                </a></ul>
            <ul class="page administer"><a href="./BackstageAdministrator.php">
                    <p class="title">管理員</p>
                </a></ul>
        </nav>
    </aside>
    <section>       
        <div>
            <div class="verify_total">
                <h4>審核實名制</h4>
                    <span  style="background-color:#2C5E9E; color:#FFF">未處理</span>
                    <span>已處理</span>
                    <span>未通過</span>
            </div>
            <table>
                <!-- <tr>
                    <th>會員編號</th>
                    <th>證件照片</th>
                    <th>身分證字號</th>
                    <th>真實姓名</th>
                    <th>申請時間</th>
                    <th>申請狀態</th>
                </tr>
                <tr>
                    <td>00001</td>
                    <td><img src="../images/member/poohidcard.jpg" alt=""></td>
                    <td>A123456789</td>
                    <td>唐伯虎</td>
                    <td>2020/08/23</td>
                    <td style="text-align: left;padding-left: 10px;">
                        <form action=""><input type="radio" name="verify" id="verify_1"><label for="verify_1">通過</label><br>
                            <input type="radio" name="verify" id="verify_2"><label for="verify_2">未通過</label>
                        </form>
                    </td>
                    <td style="background-color: #eaf1f4;"><button type="submit" class="btnB_L_yellow">
                            <p>送出</p>
                            <div class="bg"></div>
                        </button></td>
                </tr> -->
            <?php 
                try	{
                    require_once('connectMeetain.php');
                    
                        $sql = 'SELECT mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間"  FROM member_realname where mem_realname_situation = "未審核" order by "申請時間" ;';
                        $pdoStatement = $pdo->query($sql);
                        $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table>
                        <tr class='cyan'><th width="80px">會員編號</th><th width="300px">證件照片</th><th width="140px">身分證字號</th><th width="80px">真實姓名</th><th width="110px">申請時間</th><th width="150px">申請狀態</th></tr>
                        <?php
                        foreach ( $prodRows as $i => $prodRow){
                        ?>
                            <tr>
                            <td class='pink'><?=$prodRow["會員編號"]?></td>
                            <td><?=$prodRow["證件照片"]?></td>
                            <td><?=$prodRow["身分證字號"]?></td>
                            <td><?=$prodRow["真實姓名"]?></td>
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
            </table>
        </div>
    </section>
</main>
<script src="./js/backstage.js"></script>
</body>
</html>