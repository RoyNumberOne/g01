//登入抓資料+驗證
let member;

function $id(id){
    return document.getElementById(id);
}

function sendForm(){
let xhr = new XMLHttpRequest();

xhr.onload = function(){
    if(xhr.status == 200){
        member = JSON.parse(xhr.responseText);
        if(member.mem_acc === undefined){
            alert("帳密錯誤");
        }else{ //登入成功
            $("#signInForm").submit();
            window.location.href = "./Member_v2.html";
            // window.history.back();
        }
    }else{
        alert(xhr.status);
    }
}

    xhr.open("post", "./login_v2.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data_info = `mem_acc=${$id("mem_acc").value}&mem_psw=${$id("mem_psw").value}`;
    xhr.send(data_info);

}

// header抓會員資料
function getLoginInFo(){
    let xhr = new XMLHttpRequest();

    xhr.onload = function(){
        member = JSON.parse(xhr.responseText);
        if (member.mem_id){
            $id("mem_info_id").innerText = member.mem_id;
            $id("mem_avatar_img").src = member.mem_avator;
            $('#mem_avatar_box').css('visibility','visible');
            $('#mem_info_id').css('visibility','visible');
            $('#Logout_btn').css('visibility','visible');

        }   
    }

    xhr.open("get", "./login_v2_LoginInFo.php",true);
    xhr.send(null);
}

// 登出
function logout(){
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        if(xhr.status == 200){
            $('#mem_avatar_box').css('visibility','hidden');
            $('#mem_info_id').css('visibility','hidden');
            $('#Logout_btn').css('visibility','hidden');
        } else  {
        }
    }
    xhr.open("get","./login_v2_Logout.php",true);
    xhr.send(null);
    window.location.href = './login_v2.html';
};

$('#Logout_btn').click(logout);



function init(){
    getLoginInFo();
    $('#btnLogin').click(sendForm);
}; 


//header判斷是否登入

function loginStatus(){
    if($('#mem_info_id').html() === ''){
        alert ('請先登入');
        window.location.href = './login_v2.html';
    }else{
        alert('歡迎登入');
        window.location.href = './Member_v2.html';
    }
}

$('#member_jumpTo').click(loginStatus);


window.addEventListener("load", init, false);