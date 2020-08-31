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
  for (i = 0; i < x.length; i++) {
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