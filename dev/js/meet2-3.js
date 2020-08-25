//apply
$('.introduction_bt').click(function(){
    $('.activity_introduction').css('display','block');
    $('.activity_application').css('display','none');
    $(this).addClass('change');
    $('.application_bt').removeClass('change');
});
$('.application_bt').click(function(){
    $('.activity_application').css('display','block');
    $('.activity_introduction').css('display','none');
    $(this).addClass('change');
    $('.introduction_bt').removeClass('change');
});


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

// lightbox
$(function(){
    $(".apply_bt").click(function(){
        $("#meet2-3-1").removeClass("close");
    })
});

$(function() {
    // 點擊不同意按鈕
    $("button#notagree").on("click", function(){
     //    console.log("click");
        $("section.agreement").removeClass("-on");
        $("section.notagree_box").addClass("-on");
    });

     // 點擊同意按鈕
    $("button#agree").on("click", function(){
     //    console.log("click");
        $("section.agreement").removeClass("-on");
        $("section.agree_box").addClass("-on");
    });

    // 點擊X按鈕
    $("button.close_btn").on("click", function(){
     //    console.log("click");
        $("main#meet2-3-1").addClass("close");
        $(".agree_box").removeClass("-on");//
        $(".notagree_box").removeClass("-on");
        $("section.agreement").addClass("-on");
    });
});