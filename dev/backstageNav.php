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
        <ul class="page index ulat"><a href=""><p class="title">首頁</p></a></ul>
        <ul class="report"><p class="title">檢舉</p>
            <li class="page navli tour"><a href=""><p class="desc">揪團</p><div class="note"><p>12</p></div></a></li>
            <li class="page navli forum"><a href=""><p class="desc">討論</p><div class="note"><p>12</p></div></a></li>
            <li class="page navli comment"><a href=""><p class="desc">留言</p><div class="note"><p>12</p></div></a></li>
        </ul>
        <ul class="verify"><p class="title">審核</p>
            <li class="page navli realname"><a href=""><p class="desc">實名制</p><div class="note"><p>12</p></div></a></li>
            <li class="page navli guide"><a href=""><p class="desc">嚮導</p><div class="note"><p>12</p></div></a></li>
        </ul>
        <ul class="page product"><a href=""><p class="title">商品</p></a></ul>
        <ul class="page administer"><a href=""><p class="title">管理員</p></a></ul>
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