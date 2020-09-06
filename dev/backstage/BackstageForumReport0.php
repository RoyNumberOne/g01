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
    <?php
        require_once("./BackstageNav.inc");
    ?>        
    </aside>
    <section>
        
        <div>
            <div class="report_total"> 
                <h4>討論文檢舉</h4>
                <span id="loadButton_1"><a href="./BackstageForumReport.php">未處理</a></span>
                <span id="loadButton_2" style="background-color:#2C5E9E; color:#FFF" ><a href="./BackstageForumReport0.php">已處理</a></span>
                <span id="loadButton_3"><a href="./BackstageForumReport1.php">未通過</a></span>
            </div>
            <div id="ccc">
                <h3>討論檢舉 - 已處理已通過</h3>
                <?php 
                    try	{
                        require_once('connectMeetain.php');
                            $sql = 'SELECT count(*) totalCount from forum_report fr where fr.forum_report_situation = "已處理已通過"';
                            $stmt = $pdo->query($sql); 
                            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                            $totalRecords = $row["totalCount"]; 
                            // echo $totalRecords;
                            $recPerPage= 3;
                            $totalPages = ceil($totalRecords / $recPerPage);
                            $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                            $start = ($pageNo-1) * $recPerPage;
                            $sql = "SELECT forum_report_no '檢舉編號' , forum_report_post '討論編號' , forum_post_title '討論標題' , forum_post_poster '被檢舉人' , forum_report_build '檢舉時間', forum_report_reason '檢舉緣由', forum_report_banLong '檢舉時長', ban_forum_date '解封時間' from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no join member mem on forum_report_mem = mem.mem_no where fr.forum_report_situation = '已處理已通過' order by forum_report_build limit $start,$recPerPage";
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
                                <td><?=$prodRow["討論標題"]?></td>
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
            </div>
        </div>
        <div class="pagebtn">
            <?php 
                for($i=1; $i<=$totalPages; $i++){
                echo "<a href='BackstageForumReport0.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                }
            ?>
        </div>
    </section>
</main>
<script src="./js/backstage.js"></script>
</body>
</html>