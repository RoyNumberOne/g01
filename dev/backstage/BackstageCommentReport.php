<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/Backstagereport.css">
    <link rel="stylesheet" href="../css/BackstageHeader.css">
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
            <ul class="page index ulat"><a href="./BackstageIndex.php">
                    <p class="title">首頁</p>
                </a></ul>
            <ul class="report">
                <p class="title" style="color:#1A95DB;">檢舉</p>
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
                <p class="title">審核</p>
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
            <div class="report_total"> 
                <h4>留言檢舉</h4>
                <span style="background-color:#2C5E9E; color:#FFF">未處理</span>
                <span>已處理</span>
                <span>未通過</span>
            </div>
            <table>
            <?php 
            try	{
                require_once('connectMeetain.php');
                
                    $sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "未處理" ;';
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
                        <td style="text-align: left;padding-left: 5px;"><?=$prodRow["留言內文"]?></td>
                        <td><?=$prodRow["被檢舉人"]?></td>
                        <td><?=$prodRow["檢舉時間"]?></td>
                        <td style="text-align: left;padding-left: 5px;"><?=$prodRow["檢舉緣由"]?></td>
                        <td style="text-align: left;padding-left: 5px;">   <label><input type="radio" value="unPass" name="review?<?=$prodRow["檢舉編號"]?>">未通過</label><br>
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
            </table>
        </div>
    </section>
</main>
<script src="./js/backstage.js"></script>
</body>
</html>