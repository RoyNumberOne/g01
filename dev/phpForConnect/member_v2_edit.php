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
                    <p class="beforeChange">暱稱</p><p style="color:#2C5E9E; font-size:14px;"><?=$memRow["mem_id"]?></p><br>
                    <input type="text" name="mem_id" id="mem_id" placeholder="請輸入想更改的暱稱">
                </div>
                <div class="mem_change">
                    <p class="beforeChange">信箱</p><p style="color:#2C5E9E; font-size:14px;"><?=$memRow["mem_mail"]?></p><br>
                    <input type="text" name="mem_mail" id="mem_mail">
                </div>
                <div class="mem_change">
                    <p class="beforeChange">密碼</p><br>
                    <input type="text" name="mem_psw" id="mem_psw">
                </div>
                <div class="mem_change">
                    <p class="beforeChange">確認密碼</p><br>
                    <input type="text" name="repassword" id="repassword">
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

<script>
    
    function $id(id){
        return document.getElementById(id);
    }	

    function editDetail(){
        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    alert(xhr.responseText); //回傳php回應的值
                }else{
                    alert(xhr.status);
                }
            }
        }

        xhr.open("post", "./phpForConnect/member_v2_editCheck.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        let data_info = `mem_id=${$id("mem_id").value}&mem_psw=${$id("mem_psw").value}&mem_mail=${$id("mem_mail").value}`;
        xhr.send(data_info);


    }
    function jump() {
        window.location.href = './login_v2.html';
    }
    function Send(){
        editDetail();
        jump();
    }
    window.addEventListener("load", function(){
        document.getElementById("editConfirm").addEventListener("click", Send, false);
    }, false);
</script>
