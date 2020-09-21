// =======================001個資頭像修改======================
function readURL(input){
  if(input.files && input.files[0]){
      var reader = new FileReader();

      reader.onload = function(e){
          $('#img_ava').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
};

$("#imgInp").change(function(){
readURL(this);
});
// =======================個資頭像修改======================
//========================002桌機板按鈕========================

function tabId(evt, className) {
  var i, x, tabpage;
  x = document.getElementsByClassName("pages");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tabpage = document.getElementsByClassName("tabbutton");
  for (i = 0; i <= x.length; i++) {
     tabpage[i].classList.remove("highlight");
  }
  document.getElementById(className).style.display = "block";
  evt.currentTarget.classList.add("highlight");
}

var mybtn = document.getElementsByClassName("now")[0];
mybtn.click();

// ========================桌機板按鈕=======================
// =========================003收藏頁頁簽======================
function openClass(evt, className) {
  var i, x, tablinks;
  x = document.getElementsByClassName("class");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].classList.remove("colorpoint");
  }
  document.getElementById(className).style.display = "block";
  evt.currentTarget.classList.add("colorpoint");
}

var mybtn = document.getElementsByClassName("btn")[0];
mybtn.click();
// =======================收藏頁頁簽========================
// =====================004足跡頁地區切換======================
function tabArea(evt, className) {
  var i, x, tabareas;
  x = document.getElementsByClassName("area");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tabareas = document.getElementsByClassName("tabarea");
  for (i = 0; i < x.length; i++) {
    tabareas[i].classList.remove("thispoint");
  }
  document.getElementById(className).style.display = "block";
  evt.currentTarget.classList.add("thispoint");
}

var mybtn = document.getElementsByClassName("this")[0];
mybtn.click();
// =====================足跡頁地區切換========================
// =====================005修改頁抓id/email======================
function getMemberDetail(){
  let xhr = new XMLHttpRequest();

  xhr.onload = function(){
      member = JSON.parse(xhr.responseText);
      if (member.mem_id){
          $id("memEdit_id").innerText = member.mem_id;
          $id("memEdit_mail").innerText = member.mem_mail;
      }   
  }
 

  xhr.open("get", "./login_v2_LoginInFo.php",true);
  xhr.send(null);
}

getMemberDetail();
// =====================修改頁抓id/email========================
// =====================會員大頭照/背景/name========================
function getMemberFo(){
  let xhr = new XMLHttpRequest();

  xhr.onload = function(){
      member = JSON.parse(xhr.responseText);
      if (member.mem_id){
          $id("memProfile_img").src = member.mem_avator; //會員頁大頭照
          $id("mem_bg").src = member.mem_bg; //會員頁背景
          $id("memProfile_name").innerText = member.mem_id; //會員頁名稱
          $id("badge_1").src = member.mem_badge1;
            if($("#badge_1").attr('src','undefined')){
              $('#badge_1').css('display','none');
            };
          $id("badge_2").src = member.mem_badge2;
            if($("#badge_2").attr('src','undefined')){
              $('#badge_2').css('display','none');
            };
          $id("badge_3").src = member.mem_badge3;
            if($("#badge_3").attr('src','undefined')){
              $('#badge_3').css('display','none');
            };
      }   
  }

  xhr.open("get", "./login_v2_LoginInFo.php",true);
  xhr.send(null);
}

getMemberFo();
// =====================會員大頭照/背景/name========================