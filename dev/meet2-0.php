<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友｜揪團</title>
    
    <!-- 套用字體 -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
     <!-- 套用icon  -->
	<link rel="stylesheet" href="./css/fa5.14.0all.min.css">
    <link rel="stylesheet" href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="./css/meet2-0.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/header.css">
    <script src="./js/fa5.14.0all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

     <!-- Google Map  -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=&v=weekly" defer>
        // key=YOUR_API_KEY&callback= 
    </script>
    <script src="./js/jquery-3.5.1.js"></script>

</head>
<body class="meet2-0_body">


    <header>
        <div id="headerbox">
            <a href="./Frontstageindex.html" class="logo">
                <img class="logo" src="./images/logo/LOGO_white.png" alt="">
            </a> 

            <nav class="menuhover">
                <ul class="menuhover">
                    <li class="bg bg1"></li>
                    <li class="bg bg2"></li>
                    <li class="bg bg3"></li>
                </ul>
            </nav>

            <nav class="menu">
                <ul class="link_list llleft">
                    <li><a class="tour" href="./meet2-0.html"><p>揪團區</p></a></li>
                    <li><a class="forum" href="./forum.html"><p>討論區</p></a></li>
                    <li><a class="product" href="./product.html"><p>商品區</p></a></li>
                </ul>
                <ul class="link_list llright">
                    <li>
                        <div id="mem_avatar_box"><img id="mem_avatar_img" src=""></div>
                    </li>
                    <li><div id="mem_info_id"></div></li>
                    <li><button id="Logout_btn" class="btnB_L_grey"><p>登出</p><div class="bg"><br></div></button></li>
                    <li><a class="member" id="member_jumpTo"><div class="memicon"><div class="membg"></div></div></a></li>
                    <li><a class="cart" href="./shoppingcart.html"><div class="carticon"><span class="add_count_others"></span><div class="cartbg"></div></div></a></li>
                    
                </ul>
            </nav>
            <div id="imagebox">
                <img id="picTour" src="./images/header/tour.png" alt="">
                <img id="picForum" src="./images/header/forum.png" alt="">
                <img id="picProduct" src="./images/header/product.png" alt="">
            </div>

            <div id="greymask"></div>
            <div id="hamburgerBG">
                <div class="ab white"></div>
                <div class="ab yellow1"></div>
                <div class="ab yellow2"></div>
                <div class="ab yellow3"></div>
            </div>
            <button class="hamburger hamburger--collapse" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </header>

    <main id="meet2-0">
        <section class="serchMeet">
            <h2 class="text_underline">搜尋揪團</h2>
            <div class="searchFormMap">
                <!-- <form class="serch">
                    <div class="location">
                        <p>地區</p>
                        <div> 
                            <label for="north"><input type="checkbox" name="north" id="north"><p class="searchLocation">北部</p></label>
                            <label for="west"><input type="checkbox"  name="west" id="west"><p class="searchLocation">中部</p></label>
                            <label for="south"><input type="checkbox" name="south" id="south"><p class="searchLocation">南部</p></label>
                            <label for="east"><input type="checkbox"  name="east" id="east"><p class="searchLocation">東部</p></label>
                        </div>   
                    </div>
                    <div class="degree">
                        <p>難度</p>
                        <div> 
                            <label for="degree1"><input type="checkbox" name="degree1" id="degree1"><p class="searchDegre">Ａ級</p></label>
                            <label for="degree2"><input type="checkbox"  name="degree2" id="degree2"><p class="searchDegre">Ｂ級</p></label>
                            <label for="degree3"><input type="checkbox" name="degree3" id="degree3"><p class="searchDegre">Ｃ級</p></label>
                            <label for="degree4"><input type="checkbox"  name="degree4" id="degree4"><p class="searchDegre">Ｄ級</p></label>
                        </div>   
                    </div> 
                    <button type="button" class="btnB_L_yellow"><p>搜尋</p><div class="bg"></div></button>
                </form> -->
                <div id="searchMap" class="serchMap">
                </div>
            </div>
        </section>
       
        <section class="hotMeet1">    
            <h2 class="text_underline">熱門揪團</h2>


            <div class="top1-3">
                <div class="meettop" id="meettop">
                    <div class="top1" v-for="(hotmeet, index, mountain_area) in meetList">
                        <div class="hot_meet_top3" >
                            <div class="meet_mountain_img">
                                <img v-bind:src="hotmeet.mountain_image" alt="">
                            </div>
                            <div class="meet_content">
                                <img  class="bg_cloud" src="./images/meet/2-0-cloud2.svg" alt="">
                                
                                <div class="member_styleA column">
                                    <div class="memberImg">
                                        <img v-bind:src="hotmeet.mem_avator" alt="">
                                    </div>
                                    <div class="memberInfo">
                                        <div class="certification">
                                            <span class="certificationIcon">{{hotmeet.mem_realname}}<img src="./images/icons/icon_realname.svg" alt=""></span>
                                            <span class="certificationIcon b">{{hotmeet.guide_no}}<img src="./images/icons/icon_guide.svg" alt=""></span>
                                        </div>
                                        <div class="memberId">{{hotmeet.mem_id}}</div>
                                        <div class="memberBadge">
                                            <span class="memberBadgeIcon">{{hotmeet.mem_badge1}}
                                                <img src="./images/member/Ach_list_03.png" alt="">
                                            </span>
                                            <span class="memberBadgeIcon">{{hotmeet.mem_badge2}}
                                                <img src="./images/member/Ach_list_03.png" alt="">
                                            </span>
                                            <span class="memberBadgeIcon">{{hotmeet.mem_badge3}}
                                                <img src="./images/member/Ach_list_03.png" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="title_info_text">
                                    <div class="upspace"></div>
                                    <h3>{{hotmeet.tour_title}}</h3>
                                    <div class="info">
                                        <span class="tag">＃{{hotmeet.mountain_name}}</span>
                                        <span class="tag">＃{{hotmeet.days}}天</span>
                                        <span class="tag">＃{{hotmeet.tour_min_number}}~{{hotmeet.tour_max_number}}人</span>
                                        <div class="locationDegree">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="location">{{hotmeet.mountain_area | Area}}</span>
                                            |
                                            <span class="degree"><div class="degreeImg" v-html="Degree(hotmeet.degree_category)"></div></span>
                                        </div>
                                        <span class="date">{{hotmeet.tour_activitystart}}</span><span>出發</span>
                                        ｜
                                        <span class="date">{{hotmeet.tour_activityend}}</span><span>回程</span>
    
                                    </div>


                                    <div class="text_btn">
                                        <div class="meetContent">
                                            <p class="textContent">{{hotmeet.tour_innertext}}</p>
                                        </div>
                                        <div class="more_btn">
                                            <a :href="'./meet2-3.html?tour_no=' + hotmeet.tour_no"><button class="btnA_LwRA"><p>更多</p><div class="btnArrowL"></div></button></a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- <div class="like_btn">
                                    <div class="heartIcon">
                                        <div class="changeIcon">
                                            <img class="heart" src="./images/icons/icon_heart.svg" >
                                        </div>
                                    </div>
                                    <div>
                                        <a :href="'./meet2-3.html?tour_no=' + hotmeet.tour_no"><button class="btnA_LwRA"><p>更多</p><div class="btnArrowL"></div></button></a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top1-3_bg">
                    <img src="./images/meet/2-0-bg_top3_1.svg" alt="">
                </div>
                <div class="decoration_draw">
                    <img src="./images/meet/2-0-decoration_draw1.svg" alt="">
                </div>
            </div>
            


        </section>
        
        <section class="newMeet" > <!-- 最新揪團 -->
            <h2 class="text_underline">最新揪團</h2>

            <div class="changeTypeBtn">
                <div class="typeCard -on"></div>
                <div class="typeList"></div>
            </div>
            <?php
                try{
                    require_once('connectMeetain.php');
                    // pag ===========================
                    $sql = "select count(*) totalCount from tour where tour_situation = 1 and tour_progress = '報名中';";
                    $stmt = $pdo->query($sql); 
                    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                    $totalRecords = $row["totalCount"]; 
                    // echo $totalRecords;
                    $recPerPage= 8;
                    $totalPages = ceil($totalRecords / $recPerPage);
                    $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                    $start = ($pageNo-1) * $recPerPage; 
                    // pag ===========================


                    $sql = "SELECT  t.tour_no , t.tour_hoster, m.mem_avator,m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , mt.mountain_area ,mt.degree_category, t.tour_mountain , mt.mountain_name,mt.mountain_image ,  t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*) ,t.tour_min_number,t.tour_max_number, DATEDIFF(t.tour_activityend ,t.tour_activitystart)+1 days
                                FROM tour t
                                        LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
                                        LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
                                        JOIN member m ON t.tour_hoster = m.mem_no
                                        LEFT OUTER JOIN comment_post c ON t.tour_no = c.tour_post_no
                                        JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
                                WHERE t.tour_situation = 1 and tour_progress = '報名中'
                                GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no , c.tour_post_no
                                ORDER BY t.tour_build DESC , t.tour_no DESC
                                limit $start,$recPerPage"; //$recPerPage 每頁幾筆資料
                    $pdoStatement = $pdo->query($sql);
                    $tourRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);


                    foreach ( $tourRows as $i => $tourRow){
                         

                    }


                }	catch	(PDOException $e)	{
                }
            ?>
            <div class="newMeetActivity card" id="newmeet">
                <div class="item" v-for="(meet, index, mountain_area) in meetList">
                    <a :href="'./meet2-3.html?tour_no=' + meet.tour_no">
                        <div class="newImg">
                            <img v-bind:src="meet.mountain_image" alt="">
                        </div>
                    </a>
                    <div class="newMeetTextCont">
                        <div class="tittleLike">
                            <a :href="'./meet2-3.html?tour_no=' + meet.tour_no">
                                <h3>{{meet.tour_title}}</h3>
                            </a>
                        </div>
                        <div class="info">
                            <span class="tag">＃{{meet.mountain_name}}</span>
                            <span class="tag">＃{{meet.days}}天</span>
                            <span class="tag">＃{{meet.tour_min_number}}~{{meet.tour_max_number}}人</span>
                            <div class="locationDegree">
                                <!-- 沒有成功  -->
                                <span class="location">{{meet.mountain_area | Area}}</span>
                                <span class="degree"><div class="degreeImg" v-html="Degree(meet.degree_category)"></div></span>
                            </div>
                            <span class="date">{{meet.tour_activitystart}}</span><span>出發</span>
                            ｜
                            <span class="date">{{meet.tour_activityend}}</span><span>回程</span>
                        </div>
                        <div class="meetContent">
                            <p class="textContent">
                                {{meet.tour_innertext}}
                            </p>
                        </div>
                    </div>
                    <div class="member_styleA row">
                        <div class="memberImg">
                            <img v-bind:src="meet.mem_avator" alt="">

                        </div>
                        <div class="memberInfo">
                            <div class="certification">
                                <span class="certificationIcon"><img src="./images/icons/icon_realname.svg" alt="">{{meet.mem_realname}}</span>
                                <span class="certificationIcon b"><img src="./images/icons/icon_guide.svg" alt="">{{meet.guide_no}}</span>
                            </div>
                            <div class="memberId">{{meet.mem_id}}</div>
                            <div class="memberBadge">
                                <span class="memberBadgeIcon">{{meet.mem_badge1}}
                                    <img src="./images/member/Ach_list_03.png" alt="">
                                </span>
                                <span class="memberBadgeIcon">{{meet.mem_badge2}}
                                    <img src="./images/member/Ach_list_03.png" alt="">
                                </span>
                                <span class="memberBadgeIcon">{{meet.mem_badge3}}
                                    <img src="./images/member/Ach_list_03.png" alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                   
                </div>

            </div>

            <!-- 頁 碼======================================== -->
            <div class="pagebtn">
                <?php 
                    for($i=1; $i<=$totalPages; $i++){
                        // ====== 
                        //echo "<a href='Backstageproduct.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                        echo "<a href='meet2-0.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                    }
                ?>
            </div> 
          
        </section>
        
    </main>

     <!-- -------------------------aside link------------------------- -->
     <div id="aside-link">
        <div class="aside-com-btn">
            <a href="./meet2-2.html" target="_blank" ><img src="./images/form_img/want2.png" alt=""></a>
        </div>
    </div>

    <!-- -------------------------GO TOP------------------------- -->
    <a href="#" id="gotop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <footer class="footer">
        <div class="footer_logo_block">
            <a href="./FrontstageIndex.html">
                <img src="./images/logo/LOGO_white.png" alt="">
            </a>
            <div class="copyright">Copyright © 2020 Mountain Community.</div>
        </div>
        <div class="footer_info">
            <div class="sevrves_place-serves_tel">
                <div class="place">
                    <div class="f_color1">桃園市中壢區中大路300號</div>
                    <div class="f_color1">工程二館 資策會大樓</div>
                </div>
                <div class="tel">
                    <div class="f_color1">連絡電話</div>
                    <div class="f_color1">(03)425-7387</div>
                </div>
            </div>
            <div class="serves_time-serves_email">
                <div class="time">
                    <div class="f_color1">服務時間</div>
                    <div class="f_color1">週一至週五10:00~17:00</div>
                </div>
                <div class="email">
                    <div class="f_color1">服務信箱</div>
                    <div class="f_color1">tibame@gmail.com</div>
                </div>
            </div>
            <div class="epaper-footer_link">
                <div class="epaper">
                    <div class="etitle f_color1">輸入信箱訂閱電子報</div>
                    <div class="einput">
                        <input type="text" placeholder="Email address">
                        <div class="e_bt f_color1">SUBSCRIBE</e_bt>
                    </div>
                </div>
                <div class="link">
                    <div class="linkup">
                        <div><a href="https://www.cwb.gov.tw/V8/C/" target="_blank">中央氣象局</a></div>
                        <div><a href="https://npm.cpami.gov.tw/" target="_blank">登山證申請</a></div>
                        <div><a href="" target="_blank">網站快速導覽</a></div>
                    </div>
                    <div class="linkdown">
                        <div><a href="" target="_blank">服務條款及隱私權政策</a></div>
                        <div><a href="" target="_blank">會員使用條款</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- 載入 jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- -------------------------頁 碼------------------------- -->
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
    <!----go top----->
    <script src="./js/fa5.14.0all.js"></script>

    <script src="./js/meet2-0.js"></script>
    <script src="./js/header.js" ></script>
    <script src="./js/login_v2.js"></script>
    
    <script src="./js/meet2-0_map2.js"></script>
</body>
</html>