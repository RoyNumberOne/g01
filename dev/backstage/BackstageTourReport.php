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
                <span id="loadButton_1" style="background-color:#2C5E9E; color:#FFF"><a href="./BackstageTourReport.php">未處理</a></span>
                <span id="loadButton_2"><a href="./BackstageTourReport0.php">已通過</a></span>
                <span id="loadButton_3"><a href="./BackstageTourReport1.php">未通過</a></span>
            </div>
            <div id="ccc">
                <h3>揪團檢舉 - 未處理</h3>
                <?php 
                    try	{
                        require_once('connectMeetain.php');
                            $sql = 'SELECT count(*) totalCount from tour_report tr where tr.tour_report_situation = "未處理"';
                            $stmt = $pdo->query($sql); 
                            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                            $totalRecords = $row["totalCount"]; 
                            $recPerPage= 2;
                            $totalPages = ceil($totalRecords / $recPerPage);
                            $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                            $start = ($pageNo-1) * $recPerPage; 
                            $sql = "SELECT tour_report_no '檢舉編號' , tour_report_tour '揪團編號' , tour_title '揪團標題' , tour_hoster '被檢舉人' , tour_report_build '檢舉時間', tour_report_reason '檢舉緣由' from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = '未處理' limit $start,$recPerPage";
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <table>
                            <tr class='cyan'><th>檢舉編號</th><th>揪團編號</th><th>揪團標題</th><th>被檢舉人</th><th>檢舉緣由</th><th>檢舉時間</th><th>檢舉狀態</th><th>確認</th></tr>
                            <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?>
                                <tr>
                                <td class='pink' style="width:90px;"><?=$prodRow["檢舉編號"]?></td>
                                <td><a href="../meet2-3.html?tour_no=<?=$prodRow["揪團編號"]?>"><input style="cursor:pointer;" type="text" disabled name="REVIEWtrNo<?=$prodRow["檢舉編號"]?>" readonly value="<?=$prodRow["揪團編號"]?>"></a></td>
                                <td style="text-align: left;padding-left: 5px;" id="comm"><?=$prodRow["揪團標題"]?></td>
                                <td><input type="text" disabled name="REVIEWtrMember<?=$prodRow["檢舉編號"]?>" readonly value="<?=$prodRow["被檢舉人"]?>"></td>
                                <td style="text-align: left;padding-left: 5px;" id="comm"><?=$prodRow["檢舉緣由"]?></td>
                                <td><?=$prodRow["檢舉時間"]?></td>
                                <td style="text-align: left;padding-left: 10px;">
                                    <label><input type="radio" value="已處理未通過" name="REVIEWtr<?=$prodRow["檢舉編號"]?>" class="inputsize">未通過</label><br>
                                    <label><input type="radio" value="已處理已通過" name="REVIEWtr<?=$prodRow["檢舉編號"]?>" class="inputsize">通過，禁言</label>
                                    <select name="BANLONGtr<?=$prodRow["檢舉編號"]?>">
                                        <option value="5">5分鐘</option>
                                        <option value="4320" selected="selected">3天</option>
                                        <option value="10080">7天</option>
                                        <option value="20160">14天</option>
                                        <option value="40320">28天</option>
                                    </select>
                                </td>
                                <td><label><input name="<?=$prodRow["檢舉編號"]?>" type="button" value="送出" class="sendtourreport" id="sendtourreport" disabled></label></td>
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
                echo "<a href='BackstageTourReport.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
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
<script>
// 有選結果才能打開送出button
$('input[type="radio"]').change(function(){
    $(this).parent().parent().next().children().children().removeAttr("disabled");
});
</script>

<script>
// 揪團檢舉 － 結果送出
$(Document).ready(function(){
    $(".sendtourreport").click(function(){

        var temp = $(this).attr('name');
        let REVIEWtrIfPass = $("input[name='REVIEWtr"+temp+"']:checked").val();
        let REVIEWtrBanLong = $("select[name='BANLONGtr"+temp+"']").val();
        let REVIEWtrMember = $("input[name='REVIEWtrMember"+temp+"']").val();
        let REVIEWtrNo = $("input[name='REVIEWtrNo"+temp+"']").val();
        
        // console.log(temp);
        // console.log(REVIEWtrIfPass);
        // console.log(REVIEWtrBanLong);
        // console.log(REVIEWtrMember);

        // if (REVIEWtrBanLong)

        if ( REVIEWtrIfPass == '已處理未通過'){
            console.log ('已處理未通過')

            $.ajax({
                url: './BackstageREVIEWtrUnPass.php',
                data: {	tour_report_no: temp,
                        REVIEWtrIfPass: REVIEWtrIfPass ,
                    },
                type: 'POST',   
                success(){
                } ,
            });

        }	else	{
            console.log ('已處理已通過')

            $.ajax({
                url: './BackstageREVIEWtrPass.php',
                data: {	tour_report_no: temp,
                        REVIEWtrIfPass: REVIEWtrIfPass ,
                        REVIEWtrBanLong: REVIEWtrBanLong,
                        REVIEWtrMember: REVIEWtrMember,
                        REVIEWtrNo: REVIEWtrNo,
                    },
                type: 'POST',   
                success(){
                    console.log('ya')
                } ,
            });

        }
        $(this).prop('disabled', 'disabled');
        $(this).parent().parent().prev().children().prop("disabled","disabled");
        $(this).parent().parent().prev().children().children().prop("disabled","disabled");
    })
})
 </script>
<script src="./js/backstage.js"></script>
</body>
</html>