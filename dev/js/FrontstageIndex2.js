
function $id(id){
	return document.getElementById(id);
}	


$(document).ready(function() {
    $('#fullpage').fullpage({

    //Navigation
    menu: true,//绑定菜单，设定的相关属性与 anchors 的值对应后，菜单可以控制滚动
    lockAnchors: true,//锁定锚链接不随页面滑动而改变
    anchors:['Page1', 'Page2', 'Page3', 'Page4'],//锚链接，数组中元素对应各个页面的锚链接
    navigation: true,//有无导航栏
    navigationPosition: 'left',//导航栏位置
    navigationTooltips: ['首頁', '揪團區', '討論區', '商品區'],//导航栏提示文字，与页面一一对应
    showActiveTooltip: false,//是否显示当前页面提示文字
    slidesNavigation: true,//有无幻灯片（横向）导航栏
    slidesNavPosition: 'bottom',//幻灯片（横向）导航栏位置

    loopBottom: true,
    loopTop: true,

    sectionsColor: ['transparent', 'transparent', 'transparent', 'transparent'],
    });
});
// new fullpage('#fullpage', {
// });


function checkbg(){
    if($("#section1").hasClass("active")){
        // console.log('section1')
        $(".scene.r > img").css("opacity","0");
        $(".mountainmiddle.r > img").css("opacity","0");
        $(".mountainfirst.r > img").css("opacity","0");

};
    if($("#section2").hasClass("active")){
        $(".scene.r > img").css("opacity","1");
        $(".mountainmiddle.r > img").css("opacity","1");
        $(".mountainfirst.r > img").css("opacity","1");
        $(".scene.r > img").attr("src","./images/index/noon/sky.png");
        $(".mountainmiddle.r > img").attr("src","./images/index/noon/mountain2.png");
        $(".mountainfirst.r > img").attr("src","./images/index/noon/mountain1.png");
    };
    if($("#section3").hasClass("active")){
        $(".scene.r > img").css("opacity","1");
        $(".mountainmiddle.r > img").css("opacity","1");
        $(".mountainfirst.r > img").css("opacity","1");
        $(".scene.r > img").attr("src","./images/index/sunset/sky.png");
        $(".mountainmiddle.r > img").attr("src","./images/index/sunset/mountain2.png");
        $(".mountainfirst.r > img").attr("src","./images/index/sunset/mountain1.png");
    };
    if($("#section4").hasClass("active")){
        $(".scene.r > img").css("opacity","1");
        $(".mountainmiddle.r > img").css("opacity","1");
        $(".mountainfirst.r > img").css("opacity","1");
        $(".scene.r > img").attr("src","./images/index/night/sky.png");
        $(".mountainmiddle.r > img").attr("src","./images/index/night/mountain2.png");
        $(".mountainfirst.r > img").attr("src","./images/index/night/mountain1.png");
    };
}


function pg1ani(){

setTimeout(function(){
    $(".scenefade1 > img").attr("src","./images/index/sunset/sky.png");
    $(".mountainmiddlefade1 > img").attr("src","./images/index/sunset/mountain2.png");
    $(".mountainfirstfade1 > img").attr("src","./images/index/sunset/mountain1.png");
    setInterval(function(){
        $(".scenefade1 > img").attr("src","./images/index/sunset/sky.png");
        $(".mountainmiddlefade1 > img").attr("src","./images/index/sunset/mountain2.png");
        $(".mountainfirstfade1 > img").attr("src","./images/index/sunset/mountain1.png");
    },24000)
} , 9000)

setTimeout(function(){
    $(".scenefade2 > img").attr("src","./images/index/night/sky.png");
    $(".mountainmiddlefade2 > img").attr("src","./images/index/night/mountain2.png");
    $(".mountainfirstfade2 > img").attr("src","./images/index/night/mountain1.png");
    setInterval(function(){
        $(".scenefade2 > img").attr("src","./images/index/night/sky.png");
        $(".mountainmiddlefade2 > img").attr("src","./images/index/night/mountain2.png");
        $(".mountainfirstfade2 > img").attr("src","./images/index/night/mountain1.png");
    },24000)
} , 15000)

setTimeout(function(){
    $(".scenefade1 > img").attr("src","./images/index/morning/sky.png");
    $(".mountainmiddlefade1 > img").attr("src","./images/index/morning/s1_mountain2-2.png");
    $(".mountainfirstfade1 > img").attr("src","./images/index/morning/mountain1.png");
    setInterval(function(){
        $(".scenefade1 > img").attr("src","./images/index/morning/sky.png");
        $(".mountainmiddlefade1 > img").attr("src","./images/index/morning/s1_mountain2-2.png");
        $(".mountainfirstfade1 > img").attr("src","./images/index/morning/mountain1.png");
    },24000)
} , 21000)

setTimeout(function(){
    $(".scenefade2 > img").attr("src","./images/index/noon/sky.png");
    $(".mountainmiddlefade2 > img").attr("src","./images/index/noon/mountain2.png");
    $(".mountainfirstfade2 > img").attr("src","./images/index/noon/mountain1.png");
    setInterval(function(){
        $(".scenefade2 > img").attr("src","./images/index/noon/sky.png");
        $(".mountainmiddlefade2 > img").attr("src","./images/index/noon/mountain2.png");
        $(".mountainfirstfade2 > img").attr("src","./images/index/noon/mountain1.png");
    },24000)
} , 27000)

}

$(document).ready(
    pg1ani()
);

$(document).ready(
    checkbg()
);

$(window).mousemove(function(evt){

var pagex =evt.pageX;
var pagey =evt.pageY;

$(".scene img").css("left",`calc(50vw - 1000px + ${pagex/30}px)`)
$(".mountainmiddle img").css("left",`calc(50vw - 1000px + ${pagex/55}px)`)
$(".mountainfirst img").css("left",`calc(50vw - 1000px + ${pagex/80}px)`)

$(".scenefade img").css("left",`calc(50vw - 1000px + ${pagex/30}px)`)
$(".mountainmiddlefade img").css("left",`calc(50vw - 1000px + ${pagex/55}px)`)
$(".mountainfirstfade img").css("left",`calc(50vw - 1000px + ${pagex/80}px)`)

checkbg();
})

$(window).scroll(function() {
    // alert(123);
});

$(document).scroll(function(){
    // alert(123);
})

$(window).bind('mousewheel', function(e){
    if(e.originalEvent.wheelDelta /120 > 0) {
        checkbg();
        console.log('scrolling up');
    }
    else{
        checkbg();
        console.log('scrolling down');
    }
});

// $(document).ready(
// $("#fp-nav").click(function(){
//     alert(123);
//     checkbg();
// })
// );

$(document).ready(
$(document).on('keydown',function(e) {
    checkbg();
}));



















// function checkbig(){
//     $("#sec3-1box .big .bigimg img").attr('src' , $("#sec3-1box .is-active img").attr('src'));
//     $("#sec3-1box .big .posteravator img").attr('src' , $('#sec3-1box .is-active .inforplace .posteravator').attr('src'));
//     $("#sec3-1box .big .commentmem img").attr('src' , $('#sec3-1box .is-active .inforplace .commentmem').attr('src'));
//     $id('posteridp').innerText  =  $('#sec3-1box .is-active .inforplace .posterid').attr('innerHTML');
//     $id('innertextp').innerText  =  $('#sec3-1box .is-active .inforplace .innertext').attr('innerHTML');
//     $id('commenttextp').innerText  =  $('#sec3-1box .is-active .inforplace .commenttext').attr('innerHTML');
//     $("#sec3-2box .big .bigimg img").attr('src' , $("#sec3-2box .is-active img").attr('src'));
//     $("#sec3-2box .big .posteravator img").attr('src' , $('#sec3-2box .is-active .inforplace .posteravator').attr('src'));
//     $("#sec3-2box .big .commentmem img").attr('src' , $('#sec3-2box .is-active .inforplace .commentmem').attr('src'));
//     $id('posteridp2').innerText  =  $('#sec3-2box .is-active .inforplace .posterid').attr('innerHTML');
//     $id('innertextp2').innerText  =  $('#sec3-2box .is-active .inforplace .innertext').attr('innerHTML');
//     $id('commenttextp2').innerText  =  $('#sec3-2box .is-active .inforplace .commenttext').attr('innerHTML');
// }
// checkbig();


// $(".small").click(function(){
//     $(this).siblings().removeClass('is-active')
//     $(this).addClass('is-active')
//     checkbig();
// })


// let tempimgpath;
// let temptitle;
// let tempdesc;



// $("div.circlebgsmall").click(function(){
//     // setTimeout( function(){
//         tempimgpath = $(this).children('div').children("img").attr('src');
//         $(this).children('div').children("img").attr('src' , $("#big1 .productimgbig img").attr('src'))
//         $("#big1 .productimgbig img").attr('src' , tempimgpath);

//         temptitle = $(this).next().text();
//         $(this).next().text($('#bigp').text());
//         $("#bigp").text(temptitle);

//         tempdesc = $(this).next().next().text();
//         $(this).next().next().text($('#bigdesc').text());
//         $("#bigdesc").text(tempdesc);
//     // },3000)
// })
// function checkProduct(){
//     $("#sec3-1box .big .bigimg img").attr('src' , $("#sec3-1box .is-active img").attr('src'));
//     $("#sec3-1box .big .posteravator img").attr('src' , $('#sec3-1box .is-active .inforplace .posteravator').attr('src'));
//     $("#sec3-1box .big .commentmem img").attr('src' , $('#sec3-1box .is-active .inforplace .commentmem').attr('src'));
//     $id('posteridp').innerText  =  $('#sec3-1box .is-active .inforplace .posterid').attr('innerHTML');
//     $id('innertextp').innerText  =  $('#sec3-1box .is-active .inforplace .innertext').attr('innerHTML');
//     $id('commenttextp').innerText  =  $('#sec3-1box .is-active .inforplace .commenttext').attr('innerHTML');
//     $("#sec3-2box .big .bigimg img").attr('src' , $("#sec3-2box .is-active img").attr('src'));
//     $("#sec3-2box .big .posteravator img").attr('src' , $('#sec3-2box .is-active .inforplace .posteravator').attr('src'));
//     $("#sec3-2box .big .commentmem img").attr('src' , $('#sec3-2box .is-active .inforplace .commentmem').attr('src'));
//     $id('posteridp2').innerText  =  $('#sec3-2box .is-active .inforplace .posterid').attr('innerHTML');
//     $id('innertextp2').innerText  =  $('#sec3-2box .is-active .inforplace .innertext').attr('innerHTML');
//     $id('commenttextp2').innerText  =  $('#sec3-2box .is-active .inforplace .commenttext').attr('innerHTML');
// }
