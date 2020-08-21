<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./js/all.js">
</head>
<body>
    <header></header> 
    <!-- 等header公版近來 -->
    <main>
        <div class="top">
            <div class="banner"></div>
            <div class="AvatarFrame">
                <div class="frame"><img src="./images/goldleaft.png"></div>
                <div class="memAvatar"></div>
            </div>
        </div>
        <div class="middle">
            <div class="memName">
                <h2>Hiko Huang</h2>
            </div>
            <ul class="medal">
                <li><img src="./images/Achievement/Ach_list_16.png"></li>
                <li><img src="./images/Achievement/Ach_list_14.png"></li>
                <li><img src="./images/Achievement/Ach_list_01.png"></li>
            </ul>
            <a href="#" class="profile">
                <div class="profile_icon"><img src="./images/profile_icon.png"></div>
                <div class="modify">個人修改資料</div>
            </a>

        </div>
        <div class="content">
            <div class="content_box">
                <div class="aside_nav">
                    <button type="button"><img src="./images/button_A.png"><br>按鈕A</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕B</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕C</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕D</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕E</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕F</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕G</button>
                    <button type="button"><img src="./images/button_A.png"><br>按鈕H</button>
                </div>
                <div class="CB_title">
                    <h2>認證申請</h2>
                    <!-- 實名制認證 -->
                    <!-- 認證申請 -->
                    
                </div>
                <div class="C_info"><!-- ----------各頁面內容放這(start)-------------------- -->
                    <div id="certificationGuide">
                        <h3><span>嚮導認證申請表</span></h3>  
                        <?php 
                            // $to 為拷貝路徑...
                            switch($_FILES["guide_image"]["error"]){
                                case UPLOAD_ERR_OK:
                                    $dir = "images";
                                    if(file_exists($dir)==false){
                                        mkdir($dir);
                                    }
                                    $from = $_FILES["guide_image"]["tmp_name"];
                                    $to = "$dir/".$_FILES["guide_image"]["name"];
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
                            <img src="<?php echo "./$dir/".$_FILES["guide_image"]["name"]; ?> " width="500px" height="320px" id="photo"/><br> 
                            <div id="Guide_card">
                            <?php
                                echo "<table>","<tr>","<th>","證照編號：","</th>","<td>",$_POST["guide_no"],"</td>";
                                echo "<tr>","<th>","發證日期：","</th>","<td>",$_POST["guide_period_start"],"</td>";
                                echo "</tr>","</table>";
                            ?>    
                            <!-- <?php
                                // echo "證照編號：",$_POST["guide_no"],"<br>";
                                // echo "發證日期：",$_POST["guide_period_start"],"<br>";
                            ?>   -->
                            </div>
                            <a href="./"><span>回首頁</span></a>                       
                    </div>
                </div><!-- ----------各頁面內容放這(end)-------------------- -->
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>