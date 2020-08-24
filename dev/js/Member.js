// $(function(){
//     var $li = $('ul.tab-title li');
//         $($li. eq(0) .addClass('active').find('a').attr('href')).siblings('.tab-inner').hide();
    
//         $li.click(function(){
//             $($(this).find('a'). attr ('href')).show().siblings ('.tab-inner').hide();
//             $(this).addClass('active'). siblings ('.active').removeClass('active');
//         });
//     });
// =========================手機板按鈕======================

var mySwiper = new Swiper(".swiper-container", {
  pagination: ".pagination",
  paginationClickable: true,
  slidesPerView: 4,
  loop: false
});
mySwiper.on("slideChangeStart", function() {
  console.log("slide change start");
  $(".swiper-slide-next").addClass("swiper-slide-active");
});
/* Trick to fix clickable links in Slides */
$(".swiper-container .swiper-slide a").bind("click", function() {
  window.open($(this).attr("href"), "_blank");
});

// =======================手機板按鈕========================
//========================================================
function tabId(evt, className) {
  var i, x, tabpage;
  x = document.getElementsByClassName("pages");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tabpage = document.getElementsByClassName("tabbutton");
  for (i = 0; i < x.length; i++) {
     tabpage[i].classList.remove("highlight");
  }
  document.getElementById(className).style.display = "block";
  evt.currentTarget.classList.add("highlight");
}

var mybtn = document.getElementsByClassName("now")[0];
mybtn.click();

//========================================================
// =========================收藏頁頁簽======================
function openClass(evt, className) {
    var i, x, tablinks;
    x = document.getElementsByClassName("class");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
       tablinks[i].classList.remove("red");
    }
    document.getElementById(className).style.display = "block";
    evt.currentTarget.classList.add("red");
  }

var mybtn = document.getElementsByClassName("btn")[0];
mybtn.click();
// =======================收藏頁頁簽========================
// =========================揪團頁頁簽======================
// function travelchange(evt, className) {
//   var i, x, tabtravels;
//   x = document.getElementsByClassName("travel_pages");
//   for (i = 0; i < x.length; i++) {
//      x[i].style.display = "none";
//   }
//   tabtravels = document.getElementsByClassName("tabtravel");
//   for (i = 0; i < x.length; i++) {
//      tablinks[i].classList.remove("red");
//   }
//   document.getElementById(className).style.display = "block";
//   evt.currentTarget.classList.add("red");
// }

// var mybtn = document.getElementsByClassName("this")[0];
// mybtn.click();
// =======================揪團頁頁簽========================



