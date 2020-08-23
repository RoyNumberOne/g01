<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackstageNav</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/backstageNav.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.fullpage.js"></script>
</head>
<body>
    
<nav id="BackstageNav">
        <ul class="page index ulat"><a href="">
                <p class="title">首頁</p>
            </a></ul>
        <ul class="report">
            <p class="title">檢舉</p>
            <li class="page navli tour"><a href="">
                    <p class="desc">揪團</p>
                    <div class="note">
                        <p>
                            <?php 
                            try	{
                                require_once('connectMeetain.php');
                                if($pdo != false){
                                        foreach($pdo->query('SELECT count(*) from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理"') as $row) {
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
            <li class="page navli forum"><a href="">
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
            <li class="page navli comment"><a href="">
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
            <li class="page navli realname"><a href="">
                    <p class="desc">實名制</p>
                    <div class="note">
                        <p>12</p>
                    </div>
                </a></li>
            <li class="page navli guide"><a href="">
                    <p class="desc">嚮導</p>
                    <div class="note">
                        <p>12</p>
                    </div>
                </a></li>
        </ul>
        <ul class="page product"><a href="">
                <p class="title">商品</p>
            </a></ul>
        <ul class="page administer"><a href="">
                <p class="title">管理員</p>
            </a></ul>
    </nav>
    <script>
        $("ul.page").click(function(event){
            event.preventDefault();
            $("ul.page").removeClass("ulat");
            $(this).addClass("ulat");
            $(this).siblings().removeClass("ulat");
            $(this).siblings().children().removeClass("liat");
        })
        $("li.page").click(function(event){
            event.preventDefault();
            $(this).parent().siblings().removeClass("ulat");
            $("ul.page").removeClass("ulat");
            $("li.page").removeClass("liat");
            $(this).addClass("liat");
            $(this).parent().addClass("ulat");
        })
    </script>
</body>
</html>