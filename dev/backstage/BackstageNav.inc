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
    <ul class="page product"><a href="./BackstageProduct.php?pageNo=1&name=1">
            <p class="title">商品</p>
        </a></ul>
    <ul class="page administer"><a href="./BackstageAdministrator.php">
            <p class="title">管理員</p>
        </a></ul>
</nav>