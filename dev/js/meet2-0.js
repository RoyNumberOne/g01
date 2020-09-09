
// 最新揪團
new Vue({
    el: "#meetGroup", //html的位置
    data: {
        meetList: [],
        meetIndex: [],  //
    },

    mounted(){
        axios.get('./json/Initial_tour.json') //根據哪個json
        
        .then((res) => {
            this.meetList = res.data;

            console.log(res.data); //測試是否成功

            for(let i = 0; i< this.meetList.length; i++){  //動態生成內容，依據json有幾筆
                this.meetIndex.push(i)
            }
        })
        .catch(error => {console.log(error)}); 
    },

});


// 更換Card  list樣式          
$(function() {
    //click
    

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
            $(this).attr("src","./images/icons/icon_heart_h&c.svg");
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
        }else{
            $(this).attr("src","./images/icons/icon_heart.svg");
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