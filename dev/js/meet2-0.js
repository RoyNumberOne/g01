


//熱門揪團
new Vue({
    el: "#meettop", //html的位置
    data: {
        meetList: [],
        meetIndex: [],  //
    },
    filters: {
        Area: function(value) {
            switch(value){
                case('north'):
                    return '北部';
                break;
                case('west'):
                    return '中部';
                break;
                case('south'):
                    return '南部';
                break;
                case('east'):
                    return '東部';
                break;
                default:
                    return '沒成功哦';
                break;
            }
        },
    },
    mounted(){
        //axios.get('./json/Initial_tour.json') //根據哪個json
        axios.get('./phpForConnect/meet2-0Hotmeet.php')

        .then((res) => {
            this.meetList = res.data;

            console.log(res.data); //測試是否成功
            // console.log(this.meetList);
            for(let i = 0; i< this.meetList.length; i++){  //動態生成內容，依據json有幾筆
                this.meetIndex.push(i)
            }
        })
        .catch(error => {console.log(error)}); 
    },
    methods: {
        Degree(value) {
            switch(value){
                case('1'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('2'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('3'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('4'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div>';
                break;
                default:
                    return '應該很難';
                break;
            }
        },
        
    },

});


// 最新揪團
new Vue({
    el: "#newmeet", //html的位置
    data: {
        meetList: [],
        meetIndex: [],  //
        totalPage: 5,
        currentPage: 1,
    },
    filters: {
        Area: function(value) {
            switch(value){
                case('north'):
                    return '北部';
                break;
                case('west'):
                    return '中部';
                break;
                case('south'):
                    return '南部';
                break;
                case('east'):
                    return '東部';
                break;
                default:
                    return '沒成功哦';
                break;
            }
        },
    },
    mounted(){
        //axios.get('./json/Initial_tour.json') //根據哪個json
       this.getMeetList();
    },
    methods: {
        getMeetList(){
            axios.get(`./phpForConnect/meet2-0Newmeet.php?pageNo=${this.currentPage}`)
            .then((res) => {
                this.meetList = res.data.meetListData;
                this.totalPage = res.data.totalPage;
                console.log(res.data); //測試是否成功
                // console.log(this.meetList);
                for(let i = 0; i< this.meetList.length; i++){  //動態生成內容，依據json有幾筆
                    this.meetIndex.push(i)
                }
            })
            .catch(error => {console.log(error)}); 
        },
        Degree(value) {
            switch(value){
                case('1'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('2'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('3'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('4'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div>';
                break;
                default:
                    return '應該很難';
                break;
            }
        },
        changeHeart: function(event){
                if($(event.target).attr('src') === "./images/icons/icon_heart.svg"){
                    $(event.target).attr("src","./images/icons/icon_heart_h&c.svg");
                    console.log(123)
                }else{
                    $(event.target).attr("src","./images/icons/icon_heart.svg");
                    console.log(234)
                }
        },
        changeMeetlist(page){
            this.currentPage = page;
            this.getMeetList();
        }
    },

});



          
$(function() {
    $('.aside-com-btn').click(function (){
        if($('#mem_info_id').html() === ''){
            alert ('請先登入');
            window.location.href = './login_v2.html';
        }
    });
    // 更換Card  list樣式
    // 點擊按鈕typeCard
    $("div.typeCard").on("click", function(){
        // div.newMeetActivity
            //移除 list 樣式
        $("div.newMeetActivity").removeClass("list");
        $(".newMeet div.member_styleA").removeClass("column");
            // 加上 card 樣式
        $("div.newMeetActivity").addClass("card");
        $(".newMeet div.member_styleA").addClass("row");
        
        //btn
        $("div.typeList").removeClass("-on");
        $("div.typeCard").addClass("-on");
    });

    // 點擊按鈕typeList
    $("div.typeList").on("click", function(){
        // div.newMeetActivity
            //移除 card 樣式
        $("div.newMeetActivity").removeClass("card");
        $(".newMeet div.member_styleA").removeClass("row");
            //加上 list 樣式
        $("div.newMeetActivity").addClass("list");
        $(".newMeet div.member_styleA").addClass("column");

        //btn
        $("div.typeCard").removeClass("-on");
        $("div.typeList").addClass("-on");
    });
});
        
//<!-- 換icon card/list-->
$(document).ready(function(){
    $(".icon_card").click(function(){
        if($(".icon_card").attr('src') === "./images/icons/icon_card_w.svg"){
            $(this).attr("src","./images/icons/icon_card_b.svg");
        }else{
            $(this).attr("src","./images/icons/icon_card_w.svg");
        }
    });
});

//<!-- 收藏 換愛心 -->
$(document).ready(function(){
    $(".heart").click(function(){
        if($(this).attr('src') === "./images/icons/icon_heart.svg"){
            $(this).attr("src","./images/icons/icon_heart_h&c.svg");
            console.log(123)
        }else{
            $(this).attr("src","./images/icons/icon_heart.svg");
            console.log(234)
        }
    });
});

//<!----go top裡面的箭頭需要用到的js----->
$(function() {
    /* 按下GoTop按鈕時的事件 */
    $('#gotop').click(function(){
        $('html,body').animate({ scrollTop: 0 }, 'slow');   /* 返回到最頂上 */
        return false;
    });
    
    /* 偵測卷軸滑動時，往下滑超過400px就讓GoTop按鈕出現 */
    $(window).scroll(function() {
        if ( $(this).scrollTop() > 400){
            $('#gotop').fadeIn();
        } else {
            $('#gotop').fadeOut();
        }
    });
});

//<!-- 頁碼 -->
function checkpg(){
    if ($(".pgprev").next().hasClass("-active")) {
        $(".pgprev").css("visibility","hidden");
    }   else {
        $(".pgprev").css("visibility","visible");
    }
    if ($(".pgnext").prev().hasClass("-active")) {
        $(".pgnext").css("visibility","hidden");
    }   else{
        $(".pgnext").css("visibility","visible");
    }
}

checkpg();

$(".pg").click(function(){
    $(this).parent().children().removeClass("-active");
    $(this).addClass("-active");
    checkpg();
});

$(".pgprev").click(function(){
    if (!$(".pgprev").next().hasClass("-active")) {
        $(".-active").prev().addClass("-active");
        $(".-active").next(".-active").removeClass("-active");
    }
    checkpg();
});

$(".pgnext").click(function(){
    if (!$(".pgnext").prev().hasClass("-active")) {
        $(".-active").next().addClass("-active");
        $(".-active").prev(".-active").removeClass("-active");
    }
    checkpg();
});