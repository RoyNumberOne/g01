<?php
session_start();
try{
//前端送來的資料
    require_once("connectMeetain.php");

    $mem_id = $_SESSION["mem_id"] ;

    if(isset($_SESSION["mem_id"]) === true){
    $sql = "select * from `member` where mem_id='$mem_id';";
    $member = $pdo->prepare($sql);
    $member ->bindValue(":mem_id", $mem_id);
    $member ->execute();

    $memRow = $member->fetch(PDO::FETCH_ASSOC);


?>
        <form method="post">
            <div class="mem_frame">
                <div class="mem_change">
                    <p class="beforeChange">暱稱</p><p style="color:#2C5E9E; font-size:14px;"></p>
                    <input type="text" name="mem_id" id="mem_id" maxlength="12" placeholder="中文限5字以內,英文限12字以內" value="<?=$memRow["mem_id"]?>">
                </div>
                <div class="mem_change">
                    <p class="beforeChange">信箱</p><p style="color:#2C5E9E; font-size:14px;"></p>
                    <input type="mail" name="mem_mail" id="mem_mail" placeholder="輸入新的信箱" value="<?=$memRow["mem_mail"]?>">
                </div>
                <div class="mem_change">
                    <p class="beforeChange">密碼</p><span class="tip_length" style="color: red;">密碼長度錯誤</span><br>
                    <input type="password" name="mem_psw" id="mem_psw" maxlength="12" minlength="8" onblur="checkpas1();" placeholder="限8-12英數字">
                </div>
                <div class="mem_change">
                    <p class="beforeChange">確認密碼</p><span class="tip" style="color: red;">輸入密碼不一致</span><br>
                    <input type="password" name="repassword" id="repassword" onChange="checkpas();" placeholder="再次輸入密碼"><br>
                    <p style=color:red;text-align:center;display:block;>送出後將登出，請重新登入</p>
                </div>
                <div class="mem_button">
                    <button type="button" class="btnB_L_blue" onClick="history.back()"><p>取消</p><div class="bg"></div></button>
                    <button type="button" class="btnB_L_yellow"  id="editConfirm" ><p>送出</p><div class="bg"></div></button>
                </div>
            </div>
        </form>

        
<?php
    }

}catch(PDOException $e){
    $e -> getMessage(). "<br>";
    $e -> getLine(). "<br>";
}
?>

<!-- 判斷帳號是否已使用 -->

<script src="./js/sweetalert.min.js"></script>
<script>
    
    function $id(id){
        return document.getElementById(id);
    }	

    function editDetail(){
        var idCheck = $("#mem_id").val();
        var headerId = $("#mem_info_id").text();
        if (idCheck.length == "" ^ idCheck === headerId ) { //帳號
            // alert(headerId);
            swal('暱稱不可空白及重複',"請重新輸入","error");
            return;
        }
        
        var mail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var mailCheck = $("#mem_mail").val();
        if(mailCheck.match(mail)==null){ //email
            swal("email格式不正確","請重新輸入","error");
            return;
        }

        var pswCheck = $("#mem_psw").val();
        if (pswCheck.length < 8 ^ pswCheck.length > 12) { //密碼
            swal('密碼長度錯誤',"請檢察密碼","error");
            return;
        }

        var repassword = $("#repassword").val();
        if (repassword == "") { //密碼
            swal('確認密碼不一致',"請檢察密碼","error");
            return;
        }


        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    // alert(xhr.responseText); //回傳php回應的值
                }else{
                    // alert(xhr.status);
                }
            }
        }

        xhr.open("post", "./phpForConnect/member_v2_editCheck.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        let data_info = `mem_id=${$id("mem_id").value}&mem_psw=${$id("mem_psw").value}&mem_mail=${$id("mem_mail").value}`;
        xhr.send(data_info);

        window.location.href = './login_v2.html';
        // location.reload();
    }
    // function jump() {
    //     window.location.href = './login_v2.html';
    // }
    function Send(){
        editDetail();
        // jump();
    }
    window.addEventListener("load", function(){
        document.getElementById("editConfirm").addEventListener("click", Send, false);
    }, false);

    // 確認密碼
    $(".tip").hide();
    $(".tip_length").hide();

    function checkpas1() { //當第一個密碼框失去焦點時，觸發checkpas1事件
        var pas1 = document.getElementById("mem_psw").value;
        var pas2 = document.getElementById("repassword").value;

        if (pas1.length < 8 ^ pas1.length > 12) {
            $(".tip_length").show();
        } else {
            $(".tip_length").hide();
        }
    }

    function checkpas() { //當第一個密碼框失去焦點時，觸發checkpas2件
        var pas1 = document.getElementById("mem_psw").value;
        var pas2 = document.getElementById("repassword").value; //獲取兩個密碼框的值
        if (pas1 != pas2) {
            $(".tip").show(); //當兩個密碼不相等時則顯示錯誤資訊
            swal("密碼輸入不一致","請檢查密碼","error");
        } else {
            $(".tip").hide();
        }
    }

        // 長度判斷
        $('#mem_id').on('input', function (e) {
            var $that =  $(this),
                limit = 12;                            //定義所需字節數
            $that.attr('maxlength',limit);
            setTimeout(function(){
                var value =  $that.val(),
                    reg = /[\u4e00-\u9fa5]/g,
                    notReg = /\w/g;                     
                var Cn = value.match(reg);
                var En = value.match(notReg);
                if(Cn){
                    limit = limit - (Cn.length*2);
                }
                if(En){

                    limit = limit - En.length;
                }
                if(limit<=0){
                    var finalLen = value.length+limit;
                    value = value.substring(0,finalLen);
                    $that.attr('maxlength',limit);
                    $that[0].value = value;
                }
            },0);

        });
</script>
