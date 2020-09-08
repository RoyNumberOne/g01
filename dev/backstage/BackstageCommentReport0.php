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
                <h4>留言檢舉</h4>
                <span id="loadButton_1"><a href="./BackstageCommentReport.php">未處理</a></span>
                <span id="loadButton_2" style="background-color:#2C5E9E; color:#FFF" ><a href="./BackstageCommentReport0.php">已通過</a></span>
                <span id="loadButton_3"><a href="./BackstageCommentReport1.php">未通過</a></span>
            </div>
            <div id="ccc">
                <h3>留言檢舉 - 已處理已通過</h3>
                <?php 
                    try	{
                        require_once('connectMeetain.php');
                            $sql = 'SELECT count(*) totalCount from comment_report cr where cr.comment_report_situation = "已處理已通過" ';
                            $stmt = $pdo->query($sql); 
                            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                            $totalRecords = $row["totalCount"]; 
                            $recPerPage= 3;
                            $totalPages = ceil($totalRecords / $recPerPage);
                            $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                            $start = ($pageNo-1) * $recPerPage; 
                            $sql = "SELECT comment_report_no '檢舉編號' , comment_report_comment '留言編號' , comment_innertext '留言內文' , comment_poster '被檢舉人' , comment_report_build '檢舉時間', comment_report_reason '檢舉緣由' , comment_class '檢舉板塊' , comment_report_banLong '檢舉時長', ban_forum_date '討論區解封時間', ban_tour_date '揪團解封時間' from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no join member mem on comment_report_mem = mem.mem_no where cr.comment_report_situation = '已處理已通過' order by comment_report_build limit $start,$recPerPage";
		                    // $sql = 'SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_banLong "檢舉時長", ban_forum_date "討論區解封時間", ban_tour_date "揪團解封時間" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no join member mem on comment_report_mem = mem.mem_no where cr.comment_report_situation = "已處理已通過" order by comment_report_build ;  ;';
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <table>
                            <tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">留言編號</th><th width="300px">留言內文</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="150px">檢舉緣由</th><th width="230px">檢舉板塊</th><th width="230px">檢舉狀態</th></tr>
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
                                <td><?=$prodRow["檢舉板塊"]?></td> 
                                <td>禁言<?=$prodRow["檢舉時長"]?><br><?=$prodRow["討論區解封時間"]?></td>
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
                echo "<a href='BackstageProduct0.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                }
            ?>
        </div>
    </section>
</main>

<script>
$(Document).ready(function(){
    let url = new URL(window.location.href);
    // console.log(url);
    let curPage = new URLSearchParams(url.search);
    curPage = curPage.get("pageNo") - 1;
    // console.log(curPage);
    if (curPage == -1) { curPage = 0}
    // console.log(curPage);
    $(".pagebtn").children().eq(curPage).children().addClass('-active')
});
</script>
<script src="./js/backstage.js"></script>
</body>
</html>