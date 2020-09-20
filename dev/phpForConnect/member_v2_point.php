<script src="./js/echarts.min.js"></script>
<?php
session_start();
try{
    require_once('connectMeetain.php');
    
    $mem_no = $_SESSION["mem_no"];

    if(isset($_SESSION["mem_no"]) === true){
        $sql = "SELECT mem_point '會員點數', (mem_point_forumpost+mem_point_tourhost+mem_point_tourjoin) 'total',
                mem_point_forumpost, mem_point_tourhost,mem_point_tourjoin
                FROM member where mem_no='$mem_no';";
        $member = $pdo->prepare($sql);
        $member ->bindValue(":mem_no", $mem_no);
        $member ->execute();

        $memRow = $member->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="top_points_info">
            <div class="top_left">
                <h3>目前累積點數</h3>
                <p><?=$memRow["會員點數"]?></p>
                <p class="total_get"><?=$memRow["total"]?></p>
            </div>
            <div class="top_right" id="chart"></div>
        </div>
        <div class="bottom_points_info">

        <!-- 發文點數明細 -->
        <?php
            $sql = "SELECT forum_post_no '發文編號' , forum_post_title '發文標題' , forum_post_time '發文日期' , 8000 '獲得點數' 
                    from forum_post
                    where forum_post_poster = '$mem_no' order by forum_post_no desc LIMIT 3;";
            $pdoStatement = $pdo->query($sql);
            $forumRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <tr style="background-color:#EAF1F4"><th>發文編號</th><th>發文標題</th><th>發文日期</th><th>獲得點數</th></tr>
            <?php
                foreach ( $forumRows as $i => $forumRow){
            ?>
            <tr>
                <td><?=$forumRow["發文編號"]?></td>
                <td><?=$forumRow["發文標題"]?></td>
                <td><?=$forumRow["發文日期"]?></td>
                <td><?=$forumRow["獲得點數"]?></td>
            </tr>
        <?php } ?>
        </table>
        <br>
        <!-- 揪團區明細 -->
        <?php
            $sql = "SELECT t.tour_no '揪團編號' , t.tour_title '揪團標題', tp.tour_participate_time '揪團時間'  , 6000 '獲得點數' 
                    from tour_participate tp  join tour t on (tp.tour_participate_tour = t.tour_no and t.tour_hoster= '$mem_no' )
                    WHERE tp.tour_participate_mem = '$mem_no' order by tour_no desc LIMIT 3;";
            $pdoStatement = $pdo->query($sql);
            $tourRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <tr style="background-color:#EAF1F4"><th>揪團編號</th><th>揪團標題</th><th>揪團時間</th><th>獲得點數</th></tr>
            <?php
                foreach ( $tourRows as $i => $tourRow){
            ?>
            <tr>
                <td><?=$tourRow["揪團編號"]?></td>
                <td><?=$tourRow["揪團標題"]?></td>
                <td><?=$tourRow["揪團時間"]?></td>
                <td><?=$tourRow["獲得點數"]?></td>
            </tr>
        <?php } ?>
        </table>
        <br>
        <!-- 參團區明細 -->
        <?php
            $sql = "SELECT t.tour_no '參團編號' , t.tour_title '參團標題' , tp.tour_participate_time '參團時間' , 3000 '獲得點數'
                    from tour_participate tp  join tour t on (tp.tour_participate_tour = t.tour_no and not t.tour_hoster= '$mem_no' )
                    WHERE tp.tour_participate_mem = '$mem_no' order by tour_no desc LIMIT 3;";
            $pdoStatement = $pdo->query($sql);
            $joinRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <tr style="background-color:#EAF1F4"><th>參團編號</th><th>參團標題</th><th>參團時間</th><th>獲得點數</th></tr>
            <?php
                foreach ( $joinRows as $i => $joinRow){
            ?>
            <tr>
                <td><?=$joinRow["參團編號"]?></td>
                <td><?=$joinRow["參團標題"]?></td>
                <td><?=$joinRow["參團時間"]?></td>
                <td><?=$joinRow["獲得點數"]?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
<?php
    }
}catch(PDOException $e){

}
?>

<script>
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('chart'));   
    if(<?=$memRow["mem_point_forumpost"]?> == 0){
        myChart.setOption({
        color:["#707070","#D4521F","#F7C304"],
        series : [
            {
                name: '點數分析',
                type: 'pie',    // 设置图表类型为饼图
                radius: '80%',  // 饼图的半径，外半径为可视区尺寸（容器高宽中较小一项）的 55% 长度。
                data:[          // 数据数组，name 为数据项名称，value 为数据项值
                    {value:<?=$memRow["mem_point_forumpost"]?>, name:'發文獲得:<?=$memRow["mem_point_forumpost"]?>點'},
                    {value:<?=$memRow["mem_point_tourhost"]?>, name:'揪團獲得:<?=$memRow["mem_point_tourhost"]?>點'},
                    {value:<?=$memRow["mem_point_tourjoin"]?>, name:'參團獲得:<?=$memRow["mem_point_tourjoin"]?>點'},
                ]
            }
        ]
    })
    }else{
        myChart.setOption({
        color:["#036BA1","#D4521F","#F7C304"],
        series : [
            {
                name: '點數分析',
                type: 'pie',    // 设置图表类型为饼图
                radius: '80%',  // 饼图的半径，外半径为可视区尺寸（容器高宽中较小一项）的 55% 长度。
                data:[          // 数据数组，name 为数据项名称，value 为数据项值
                    {value:<?=$memRow["mem_point_forumpost"]?>, name:'發文獲得:<?=$memRow["mem_point_forumpost"]?>點'},
                    {value:<?=$memRow["mem_point_tourhost"]?>, name:'揪團獲得:<?=$memRow["mem_point_tourhost"]?>點'},
                    {value:<?=$memRow["mem_point_tourjoin"]?>, name:'參團獲得:<?=$memRow["mem_point_tourjoin"]?>點'},
                ]
            }
        ]
    })
    }

</script>