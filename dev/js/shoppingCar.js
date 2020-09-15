$(document).ready(function(){
    $('#sp1').css("background-color","#FFC400");
    $('#step2').hide();
    $('#step3').hide();
    $('#step4').hide();
    $('#cardp').hide();
    $('#pointp').hide();
    $('#back').hide();
    $('#ordercheckbtn').hide();

let index=1;
$('#next').on('click',function(){
    index = index+1;
    if(index == 2){
        $('#ordercheckbtn').hide();
        $('#back').show();
        $('#gotoshop').hide();
        $('#step2').show().siblings().hide();
        $('#sp2').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");

    };
    if(index == 3){
        $('#ordercheckbtn').hide();
        $('#back').show();
        $('#gotoshop').hide();
        $('#step3').show().siblings().hide();
        $('#sp3').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");
    };
    if(index == 4){
        $('#next').hide();
        $('#back').show();
        $('#ordercheckbtn').show();
        $('#gotoshop').hide();
        $('#step4').show().siblings().hide();
        $('#sp4').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");

    };
    return false;
});
$('#back').on('click',function(){
    index = index-1;
    if(index == 1){
        $('#ordercheckbtn').hide();
        $('#step1').show().siblings().hide();
        $('#back').hide();
        $('#gotoshop').show();
        $('#next').show();
        $('#sp1').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");
    };
    if(index == 2){
        $('#step2').show().siblings().hide();
        $('#gotoshop').hide();
        $('#sp2').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");

    };
    if(index == 3){
        $('#ordercheckbtn').hide();
        $('#next').show();
        $('#gotoshop').hide();
        $('#step3').show().siblings().hide();
        $('#sp3').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");

    };
return false;
});


$('#sp1').on('click',function(){
    index = 1;
    $('#ordercheckbtn').hide();
    $('#back').hide();
    $('#next').show();
    $('#gotoshop').show();
    $('#step1').show().siblings().hide();
    $('#sp1').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");
});
$('#sp2').on('click',function(){
    index = 2;
    $('#ordercheckbtn').hide();
    $('#back').show();
    $('#gotoshop').hide();
    $('#step2').show().siblings().hide();
    $('#sp2').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");
});
$('#sp3').on('click',function(){
    index = 3;
    $('#ordercheckbtn').hide();
    $('#back').show();
    $('#next').show();
    $('#gotoshop').hide();
    $('#step3').show().siblings().hide();
    $('#sp3').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");
});
$('#sp4').on('click',function(){
    index = 4;
    $('#next').hide();
    $('#back').show();
    $('#gotoshop').hide();
    $('#ordercheckbtn').show();
    $('#step4').show().siblings().hide();
    $('#sp4').css("background-color","#FFC400").siblings().css("background-color","#FFFFFF");
});

$(function(){
    $("#card").change(function() {
        $('#cardp').show();
        $('#pointp').hide();
    });
    $("#cash").change(function() {
        $('#cardp').hide();
        $('#pointp').hide();
    });
    $("#point").change(function() {
        $('#cardp').hide();
        $('#pointp').show();
        $('#pointp').load('./shoppingcartPoints.php');
    });
});

$(".item_delimg").hover(function(){ 
    $(this).attr("src", "./images/icons/icon_trash_h.svg");
    },function(){
    $(".item_delimg").attr("src", "./images/icons/icon_trash.svg");
});
//送出訂單
    $("#ordercheckbtn").click(function () {
        let order_logistics_deliver = $("#order_logistics_deliver").text();//運送方式
        let order_logistics_fee = $("#order_logistics_fee").text();//運費
        let order_cashflow = $("#order_cashflow").text();//付款方式
        let order_total = $("#order_total").text();//總金額
        let order_logistics_recipient = $("#order_logistics_recipient").text();//姓名
        let order_logistics_phone = $("#order_logistics_phone").text();//電話：
        let order_logistics_address = $("#order_logistics_address").text();//地址
        $.post(
          "./shoppingcartorder.php",
          {
            order_logistics_deliver: order_logistics_deliver,
            order_logistics_fee: order_logistics_fee,
            order_cashflow: order_cashflow,
            order_total: order_total,
            order_logistics_recipient: order_logistics_recipient,
            order_logistics_phone: order_logistics_phone,
            order_logistics_address: order_logistics_address,
          },
          function () {
            //要導去另外正確頁面
            window.location.reload(true);
          }
        );
        alert("訂單已送出");
        localStorage.removeItem("cartList");
    })

});

