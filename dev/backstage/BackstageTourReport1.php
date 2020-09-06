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
                <h4>揪團檢舉</h4>
                <span id="loadButton_1"><a href="./BackstageTourReport.php">未處理</a></span>
                <span id="loadButton_2"><a href="./BackstageTourReport0.php">已處理</a></span>
                <span id="loadButton_3" style="background-color:#2C5E9E; color:#FFF"><a href="./BackstageTourReport1.php">未通過</a></span>
            </div>
            <div id="ccc">
                <h3>揪團檢舉 - 已處理未通過</h3>
                <?php 
                    try	{
                        require_once('connectMeetain.php');
                            $sql = 'SELECT count(*) totalCount from tour_report tr where tr.tour_report_situation = "已處理未通過"';
                            $stmt = $pdo->query($sql); 
                            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                            $totalRecords = $row["totalCount"]; 
                            // echo $totalRecords;
                            $recPerPage= 2;
                            $totalPages = ceil($totalRecords / $recPerPage);
                            $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                            $start = ($pageNo-1) * $recPerPage; 
                            // $sql = "SELECT tour_report_no '檢舉編號' , tour_report_tour '揪團編號' , tour_title '揪團標題' , tour_hoster '被檢舉人' , tour_report_build '檢舉時間', tour_report_reason '檢舉緣由',tour_report_situation '檢舉狀態' from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = '已處理未通過' limit $start,$recPerPage";
		                    $sql = "SELECT tour_report_no '檢舉編號' , tour_report_tour '揪團編號' , tour_title '揪團標題' , tour_hoster '被檢舉人' , tour_report_build '檢舉時間', tour_report_reason '檢舉緣由',tour_report_situation '檢舉狀態' from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = '已處理未通過' order by tour_report_build limit $start,$recPerPage";
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
                                <td><?=$prodRow["揪團標題"]?></td>
                                <td><?=$prodRow["被檢舉人"]?></td>
                                <td><?=$prodRow["檢舉時間"]?></td>
                                <td><?=$prodRow["檢舉緣由"]?></td>
                                <td><?=$prodRow["檢舉狀態"]?></td>
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
                echo "<a href='BackstageTourReport1.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                }
            ?>
        </div>
    </section>
</main>
<script src="./js/backstage.js"></script>
</body>
</html>