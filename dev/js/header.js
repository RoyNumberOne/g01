var $hamburger = $(".hamburger");
    $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
        $("#hamburgerBG").toggleClass("on");
        $(".menu").toggleClass("on")
        $(".link_list").toggleClass("on");
        $("#greymask").toggleClass("on");
        setTimeout(function(){
    $("#greymask").toggleClass("show");
        },100)
        setTimeout(function(){
    $("#hamburgerBG").toggleClass("show");
        },150)
        setTimeout(function(){
    $(".menu").toggleClass("show");
        },200)
    });
    $("#greymask").on("click", function(e) {
    $hamburger.toggleClass("is-active");
        $("#hamburgerBG").toggleClass("on");
        $("nav.menu").toggleClass("on")
        $(".link_list").toggleClass("on");
        $("#greymask").toggleClass("on");
        setTimeout(function(){
    $("#greymask").toggleClass("show");
        },100)
        setTimeout(function(){
    $("#hamburgerBG").toggleClass("show");
        },100)
        setTimeout(function(){
    $(".menu").toggleClass("show");
        },200)
    });
    $("#hamburgerBG").on("click", function(e) {
    $hamburger.toggleClass("is-active");
        $("#hamburgerBG").toggleClass("on");
        $("nav.menu").toggleClass("on")
        $(".link_list").toggleClass("on");
        $("#greymask").toggleClass("on");
        setTimeout(function(){
    $("#greymask").toggleClass("show");
        },100)
        setTimeout(function(){
    $("#hamburgerBG").toggleClass("show");
        },100)
        setTimeout(function(){
    $(".menu").toggleClass("show");
        },200)
    });


    $("a.tour").hover(function(){
        $("div.yellow1").css("opacity", "0.9");
        $("li.bg1").css("opacity","0.9");
        $("#picTour").css("top","-25px");
    },function(){
        $("div.yellow1").css("opacity", "0");
        $("li.bg1").css("opacity","0");
        $("#picTour").css("top","100%");
    });
    $("a.forum").hover(function(){
        $("div.yellow2").css("opacity", "0.9");
        $("li.bg2").css("opacity","0.9");
        $("#picForum").css("top","-25px");
    },function(){
        $("div.yellow2").css("opacity", "0");
        $("li.bg2").css("opacity","0");
        $("#picForum").css("top","100%");
    });
    $("a.product").hover(function(){
        $("div.yellow3").css("opacity", "0.9");
        $("li.bg3").css("opacity","0.9");
        $("#picProduct").css("top","-25px");
    },function(){
        $("div.yellow3").css("opacity", "0");
        $("li.bg3").css("opacity","0");
        $("#picProduct").css("top","100%");
    });


//shopcart cartCount
if(localStorage.cartList){
    let cartCounted = function(){
        var i=0;
        for (prop in JSON.parse(localStorage.cartList)) {
        i++;
        //   console.log(JSON.parse(localStorage.cartList)[prop]);
        }
        // console.log(i);
    
        $('.add_count_others')[0].innerText = i;
    
        if(i != 0){
            $('.add_count_others').css('display', 'block')
        }else if(i=''){
            $('.add_count_others').css('display', 'none')    
        }else{
            $('.add_count_others').css('display', 'none')     
        }
    }
    cartCounted();
}



let IMGarrayHEADER = $(".memberImg img")
setTimeout(function(){
    for(var t=0 ; t<IMGarrayHEADER.length ; t++){
        if(IMGarray.eq(t).width() > IMGarray.eq(t).height() || isNaN(IMGarray.eq(t).width()) || isNaN(IMGarray.eq(t).height())){
            IMGarray.eq(t).addClass('wide')
            IMGarray.eq(t).removeClass('tall')
        }   else    {
            IMGarray.eq(t).addClass('tall')
            IMGarray.eq(t).removeClass('wide')
        }
    }
},200)