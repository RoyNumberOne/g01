
let administrator;

function $id(id){
	return document.getElementById(id);
}	


    function sendForm(){   
      let xhr = new XMLHttpRequest();

      xhr.onload = function(){
        if(xhr.status == 200){  
          console.log(xhr.responseText);
          administrator = JSON.parse(xhr.responseText);
          if (administrator.admin_acc === undefined){
            $id('admin_psw').value = '';
            $id('erroradmin').innerText = '帳號或密碼錯誤';

          } else  {
            $("#loginBox").submit();
          }
        } else  {
          alert(xhr.status);
        }
      }

      xhr.open("post", "./backstageAjaxLogin.php", true);
      xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
      // let data_info = `memId=Sara&memPsw=111`;
      let data_info = `admin_acc=${$id("admin_acc").value}&admin_psw=${$id("admin_psw").value}`;
      xhr.send(data_info);
      
    }


    function getLoginInFo(){
      let xhr = new XMLHttpRequest();

      xhr.onload = function(){
        administrator = JSON.parse(xhr.responseText);
      }

      xhr.open("get", "./backstageGetLoginInFo.php",true);
      xhr.send(null);
    }

    function init(){
      getLoginInFo();
      $id('btnLogin').onclick = sendForm;
    }; 

    window.addEventListener("load", init, false);


