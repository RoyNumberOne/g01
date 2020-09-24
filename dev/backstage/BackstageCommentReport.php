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
                <span style="background-color:#2C5E9E; color:#FFF" id="loadButton_1"><a href="./BackstageCommentReport.php">未處理</a></span>
                <span id="loadButton_2"><a href="./BackstageCommentReport0.php">已通過</a></span>
                <span id="loadButton_3"><a href="./BackstageCommentReport1.php">未通過</a></span>
            </div>
            <div id="ccc">
                <h3>留言檢舉 - 未處理</h3>
                    <?php 
                        try	{
                        require_once('connectMeetain.php');

                            //算出有幾「 筆 」（取得總比數）
                            // $sql = "select count(*) totalCount from product where product_situation=:situation";
                            $sql = 'SELECT count(*) totalCount from comment_report cr where cr.comment_report_situation = "未處理"';
                            $stmt = $pdo->query($sql); 
                            // echo $sql;
                            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                            $totalRecords = $row["totalCount"]; 
                            // echo $totalRecords;
                            //每頁要印幾筆
                            $recPerPage= 3;
                            
                            //算出有幾頁 總筆數/我每頁要印的東西
                            $totalPages = ceil($totalRecords / $recPerPage);
                            $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                            $start = ($pageNo-1) * $recPerPage; 
                            $sql = "SELECT comment_report_no '檢舉編號' , comment_report_comment '留言編號' , comment_innertext '留言內文' , comment_poster '被檢舉人' , comment_report_build '檢舉時間', comment_report_reason '檢舉緣由' , comment_class '檢舉板塊' from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = '未處理' limit $start,$recPerPage";
                            $pdoStatement = $pdo->query($sql);
                            $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                       
                            ?>
                            <table>
                            <tr class='cyan'><th width="80px">檢舉編號</th><th width="80px">留言編號</th><th width="300px">留言內文</th><th width="80px">被檢舉人</th><th width="110px">檢舉時間</th><th width="110px">檢舉板塊</th><th width="150px">檢舉緣由</th><th width="230px">檢舉狀態</th></th><th width="80px">確認</th></tr>
                            <?php
                            foreach ( $prodRows as $i => $prodRow){
                            ?> 
                                 <tr>
                                    <td class='pink'><?=$prodRow["檢舉編號"]?></td>
                                    <td><input type="text" name="REVIEWcrNo<?=$prodRow["檢舉編號"]?>" disabled readonly value="<?=$prodRow["留言編號"]?>"></td>
                                    <td style="text-align: left;padding-left: 5px;" id="comm"><?=$prodRow["留言內文"]?></td>
                                    <td><input type="text" name="REVIEWcrMember<?=$prodRow["檢舉編號"]?>" disabled readonly value="<?=$prodRow["被檢舉人"]?>"></td>
                                    <td><?=$prodRow["檢舉時間"]?></td>
                                    <td><input type="text" name="REVIEWcrClass<?=$prodRow["檢舉編號"]?>" disabled readonly value="<?=$prodRow["檢舉板塊"]?>"></td>
                                    <td style="text-align: left;padding-left: 5px;" id="comm"><?=$prodRow["檢舉緣由"]?></td>
                                    <td style="text-align: left;padding-left: 10px;width:150px;">
                                        <label><input type="radio" value="已處理未通過" name="REVIEWcr<?=$prodRow["檢舉編號"]?>" class="inputsize">未通過</label><br>
                                        <label><input type="radio" value="已處理已通過" name="REVIEWcr<?=$prodRow["檢舉編號"]?>" class="inputsize">通過，禁言</label>
                                        <select name="BANLONGcr<?=$prodRow["檢舉編號"]?>">
                                            <option value="5">5分鐘</option>
                                            <option value="4320" selected="selected">3天</option>
                                            <option value="10080">7天</option>
                                            <option value="20160">14天</option>
                                            <option value="40320">28天</option>
                                        </select>
                                    </td>
                                    <td><label><input name="<?=$prodRow["檢舉編號"]?>" type="button" value="送出" disabled class="sendcommentreport"></label></td>
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
                echo "<a href='BackstageCommentReport.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
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
$(Document).ready(function(){
    $(".sendcommentreport").click(function(){

        var temp = $(this).attr('name');
        let REVIEWcrClass = $("input[name='REVIEWcrClass"+temp+"']").val();
        let REVIEWcrIfPass = $("input[name='REVIEWcr"+temp+"']:checked").val();
        let REVIEWcrBanLong = $("select[name='BANLONGcr"+temp+"']").val();
        let REVIEWcrMember = $("input[name='REVIEWcrMember"+temp+"']").val();
        let REVIEWcrNo = $("input[name='REVIEWcrNo"+temp+"']").val();
        
        // console.log(temp);
        // console.log(REVIEWcrClass)
        // console.log(REVIEWcrIfPass);
        // console.log(REVIEWcrBanLong);
        // console.log(REVIEWcrMember);
        // console.log(REVIEWcrNo);

        // if (REVIEWcrBanLong)

        if ( REVIEWcrIfPass == '已處理未通過'){
            console.log ('已處理未通過')

            $.ajax({
                url: './BackstageREVIEWcrUnPass.php',
                data: {	comment_report_no: temp,
                        REVIEWcrIfPass: REVIEWcrIfPass ,
                    },
                type: 'POST',   
                success(){
                } ,
            });

        }	else	{
            console.log ('已處理已通過')

            $.ajax({
                url: './BackstageREVIEWcrPass.php',
                data: {	comment_report_no: temp,
                        REVIEWcrClass: REVIEWcrClass ,
                        REVIEWcrIfPass: REVIEWcrIfPass ,
                        REVIEWcrBanLong: REVIEWcrBanLong,
                        REVIEWcrMember: REVIEWcrMember,
                        REVIEWcrNo: REVIEWcrNo,
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