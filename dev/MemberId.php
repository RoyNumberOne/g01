<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&amp;display=swap">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/MemberGuide.css">
    <title>媒山友｜會員｜實名制認證</title>
</head>
<body>
<main>
    <div id="certificationGuide">
        <h2><span>感謝您的申請</span></h2>  
        <?php 
            switch($_FILES["mem_idno_image"]["error"]){
                case UPLOAD_ERR_OK:
                    $dir = "images";
                    if(file_exists($dir)==false){
                        mkdir($dir);
                    }
                    $from = $_FILES["mem_idno_image"]["tmp_name"];
                    $to = "$dir/".$_FILES["mem_idno_image"]["name"];
                    copy($from,$to);
                    echo "已送出審核","<br>";
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
                <img src="<?php echo "./$dir/".$_FILES["mem_idno_image"]["name"]; ?> " width="400px" height="250px" id="photo"/>
                <div><p>已送出審核</p></div>
            </div>
                <br> 
            <div id="Guide_card"> 
            <?php
                echo "<table>","<tr>","<th>","姓&emsp;&emsp;&emsp;名：","</th>","<td>",$_POST["mem_realname"],"</td>";
                echo "<tr>","<th>","身分證字號：","</th>","<td>",$_POST["mem_idno"],"</td>";
                echo "</tr>","</table>";
            ?>
            <a href="./FrontstageIndex.html"><button class="btnA_L"><p>回首頁</p></button></a>
            </div>
                                 
    </div>
</main>
</body>
</html>