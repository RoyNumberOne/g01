<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&amp;display=swap">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/MemberGuide.css">
    <link rel="icon" href="./images/icons/g01_logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="./images/icons/g01_logo.png" type="image/x-icon" />
    <title>媒山友｜會員｜實名制認證</title>
</head>
<body>
<main>
    <div id="certificationGuide">
        <h2><span>感謝您的申請</span></h2>  
        <?php 
            session_start();
            $mem_no = $_SESSION["mem_no"];
            $mem_realname = $_POST['mem_realname'];
            $mem_idno = $_POST['mem_idno'];
            switch($_FILES["mem_idno_image"]["error"]){
                case UPLOAD_ERR_OK:
                    $dir = "./images/realname_image";
                    if(file_exists($dir)==false){
                        mkdir($dir);
                    }
                    $from = $_FILES["mem_idno_image"]["tmp_name"];
                    $to = $dir."/".$mem_idno.'.jpg';
                    $mem_idno_image = '.'.$to;  
                    copy($from,$to);
                    echo "已送出審核","<br>";
                    require_once ('./connectMeetain.php');
                    $sql = "UPDATE member_realname 
                            set mem_realname_situation = '未審核' ,
                                `mem_realname` = '$mem_realname',
                                `mem_idno` = '$mem_idno',
                                `mem_idno_image` = '$mem_idno_image' ,
                                `mem_realname_verify` = current_timestamp
                            where `mem_no`= '$mem_no';";
                    $pdoStatement = $pdo->query($sql);
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    echo "上傳檔案過大,不得超過",ini_get("upload_max_filesize"),"<br>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "上傳檔案過大,不得超過",$_POST["MAX_FILE_SIZE"],"<br>";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "上傳檔案不完整","<br>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "檔案未選","<br>";
                    break;
                default:
                    echo "系統錯誤 請通知維護人員<br>";
            }
            ?>
            <div id="photo_b">
            <img src='<?php echo "$dir"."/"."$mem_idno".".jpg"; ?> ' width="400px" height="250px" id="photo"/>
                <div><p>已送出審核</p></div>
            </div>
                <br> 
            <div id="Guide_card"> 
            <?php
                echo "<table>","<tr>","<th>","姓&emsp;&emsp;&emsp;名：","</th>","<td>",$_POST["mem_realname"],"</td>";
                echo "<tr>","<th>","身分證字號：","</th>","<td>",$_POST["mem_idno"],"</td>";
                echo "</tr>","</table>";
            ?>
            <button class="btnB_L_blue" onclick="window.close();">
                <p>關閉視窗</p>
                <div class="bg"></div>
            </button>
            </div>
                                 
    </div>
</main>
</body>
</html>