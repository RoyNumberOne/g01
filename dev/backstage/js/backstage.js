// //側邊欄aside

// $(document).ready(function () {
//     $("ul.page").click(function (event) {
//         // event.preventDefault();
//         $("ul.page").removeClass("ulat");
//         $(this).addClass("ulat");
//         $(this).siblings().removeClass("ulat");
//         $(this).siblings().children().removeClass("liat");
//     });
//     $("li.page").click(function (event) {
//         // event.preventDefault();
//         $(this).parent().siblings().removeClass("ulat");
//         $("ul.page").removeClass("ulat");
//         $("li.page").removeClass("liat");
//         $(this).addClass("liat");
//         $(this).parent().addClass("ulat");
//     });
// });

//header抓管理員資料

let administrator;

function $id(id){
	return document.getElementById(id);
}	

function getLoginInFo(){
    let xhr = new XMLHttpRequest();

    xhr.onload = function(){
      administrator = JSON.parse(xhr.responseText);
      console.log(administrator)
      if (administrator.admin_id){
        $("#avator").attr("src","."+administrator.admin_avator)
        $id("admin_no").innerText = "#" + administrator.admin_no;
        $id("admin_id").innerText = administrator.admin_id;
      } else  {
        window.location.href = './BackstageLogin.html';
      }
    }

    xhr.open("get", "./backstageGetLoginInFo.php",true);
    xhr.send(null);
  }

getLoginInFo();

//header登出
$( document ).ready(function() {
   function logout(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
          if(xhr.status == 200){
          } else  {
          }
        }
        xhr.open("get","./BackstageLogout.php",true);
        xhr.send(null);
        window.location.href = './BackstageLogin.html';
      }

      $id('btnLogout').onclick = logout;
});