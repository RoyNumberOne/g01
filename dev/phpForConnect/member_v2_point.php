<script src="./js/echarts.min.js"></script>
<?php
session_start();
try{
    require_once('connectMeetain.php');
    
    $mem_no = $_SESSION["mem_no"];

    if(isset($_SESSION["mem_no"]) === true){
        $sql = "SELECT (mem_point_forumpost+mem_point_tourhost+mem_point_tourjoin) 'total' FROM member where mem_no='$mem_no';";
        $member = $pdo->prepare($sql);
        $member ->bindValue(":mem_no", $mem_no);
        $member ->execute();

        $memRow = $member->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="top_points_info">
        <div class="top_left">
            <h3>目前累積點數</h3>
            <p><?=$memRow["total"]?></p>
            <p class="total_get">累積獲得: $213,200</p>
        </div>
        <div class="top_right" id="chart">
            
        </div>
    </div>
    <div class="bottom_points_info">
        <!-- 發文點數明細 -->
        <?php
            $sql = "SELECT fp.forum_post_time '發文日期', fp.forum_post_no '發文編號', fp.forum_post_title '發文標題' from member m join forum_post fp on m.mem_no = fp.forum_post_poster where m.mem_no = '$mem_no' order by fp.forum_post_no desc LIMIT 3;";
            $pdoStatement = $pdo->query($sql);
            $forumRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <tr><th>發文日期</th><th>發文編號</th><th>發文標題</th></tr>
            <?php
                foreach ( $forumRows as $i => $forumRow){
            ?>
            <tr>
                <td><?=$forumRow["發文日期"]?></td>
                <td><?=$forumRow["發文編號"]?></td>
                <td><?=$forumRow["發文標題"]?></td>
            </tr>
        <?php } ?>
    </div>
<?php
    }
}catch(PDOException $e){

}
?>

<script>
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('chart'));

    myChart.setOption({
        color:["#036BA1","#D4521F","#F7C304"],
        series : [
            {
                name: '點數分析',
                type: 'pie',    // 设置图表类型为饼图
                radius: '90%',  // 饼图的半径，外半径为可视区尺寸（容器高宽中较小一项）的 55% 长度。
                data:[          // 数据数组，name 为数据项名称，value 为数据项值
                    {value:235, name:'發文獲得'},
                    {value:274, name:'揪團獲得'},
                    {value:310, name:'參團獲得'},
                ]
            }
        ]
    })
</script>