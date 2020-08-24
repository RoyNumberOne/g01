
let administrator;

function $id(id){
	return document.getElementById(id);
}	

    function showLoginForm(){
      //檢查登入bar面版上 spanLogin 的字是登入或登出
      //如果是登入，就顯示登入用的燈箱(lightBox)
      //如果是登出
      //將登入bar面版上，登入者資料清空 
      //spanLogin的字改成登入
      //將頁面上的使用者資料清掉
      // if($id('spanLogin').innerHTML == "登入"){
      //   $id('lightBox').style.display = 'block';
      // }else{ // 登出


        // 回server端做登出
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
          if(xhr.status == 200){
            $id('memName').innerHTML = '&nbsp';
            $id('spanLogin').innerHTML = '登入';
          } else  {
            alert (xhr.status);
          }
        }
        xhr.open("get","logout.php",true);
        xhr.send(null);
      // }

    }//showLoginForm

    function sendForm(){
      //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上    
      let xhr = new XMLHttpRequest();

      xhr.onload = function(){
        if(xhr.status == 200){  
          console.log(xhr.responseText);
          administrator = JSON.parse(xhr.responseText);
          if (administrator.admin_acc === undefined){
            // alert("帳密錯誤");
            $id('erroradmin').innerText = '帳密錯誤';
            $id('admin_psw').value = '';

          } else  { //登入成功
            // $id("memName").innerText = member.memName;
            // $id("spanLogin").innerText = "登出";
            // //將登入表單上的資料清空，並隱藏起來
            // $id('lightBox').style.display = 'none';
            // $id('memId').value = '';
            // $id('memPsw').value = '';
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

    // function cancelLogin(){
    //   //將登入表單上的資料清空，並將燈箱隱藏起來
    //   $id('lightBox').style.display = 'none';
    //   $id('memId').value = '';
    //   $id('memPsw').value = '';
    // }

    function getLoginInFo(){
      let xhr = new XMLHttpRequest();

      xhr.onload = function(){
        administrator = JSON.parse(xhr.responseText);
        // if (administrator.admin_id){
        //   $id("memName").innerText = member.memName;
        //   $id("spanLogin").innerText = "登出";
        // }
      }

      xhr.open("get", "./backstageGetLoginInFo.php",true);
      xhr.send(null);
    }

    function init(){
      //回server端取回登入者的資訊
      getLoginInFo();
      //===設定spanLogin.onclick 事件處理程序是 showLoginForm

    //   $id('spanLogin').onclick = showLoginForm;

      //===設定btnLogin.onclick 事件處理程序是 sendForm
      $id('btnLogin').onclick = sendForm;

      //===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
    //   $id('btnLoginCancel').onclick = cancelLogin;

    }; //window.onload

    window.addEventListener("load", init, false);
    // window.onload=init;

