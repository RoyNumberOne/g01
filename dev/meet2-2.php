<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增揪團拉！</title>
    <link rel="stylesheet" href="./css/common.css">
</head>
<body>
    

<?php
    $errMsg = "";

    try {
        require_once("./connectMeetain.php");

        //抓取會員資訊
        session_start();
        $tour_hoster = $_SESSION["mem_no"]; // 變數（會員號碼） ＝ session 抓會員號碼

        //抓前端送來的資料
        $tour_mountain = $_POST['tour_mountain'];
        $tour_title = $_POST['tour_title'];
        $tour_activitystart = $_POST['tour_activitystart'];
        $tour_activityend = $_POST['tour_activityend'];
        $tour_min_number = $_POST['tour_min_number'];
        $tour_max_number = $_POST['tour_max_number'];

        $tour_equip_1 = isset($_POST['tour_equip_1']) ? 1 : 0;
        $tour_equip_2 = isset($_POST['tour_equip_2']) ? 1 : 0;
        $tour_equip_3 = isset($_POST['tour_equip_3']) ? 1 : 0;
        $tour_equip_4 = isset($_POST['tour_equip_4']) ? 1 : 0;
        $tour_equip_5 = isset($_POST['tour_equip_5']) ? 1 : 0;

        $tour_notice = $_POST['tour_notice'];
        $tour_innertext = $_POST['tour_innertext'];

        // -----------------------先將除了照片以外資料建立，取得揪團編號------------------------------
        $sql = "INSERT INTO tour(tour_hoster, tour_mountain , tour_title, tour_activitystart, tour_activityend, 
                                tour_end , tour_min_number, tour_max_number, 
                                tour_equip_1, tour_equip_2, tour_equip_3, tour_equip_4, tour_equip_5, 
                                tour_notice, tour_innertext)
                    VALUES ('$tour_hoster', '$tour_mountain' ,'$tour_title', '$tour_activitystart', '$tour_activityend' , 
                            SUBTIME(`tour_activitystart`, '7 0:0:0'), '$tour_min_number', '$tour_max_number', 
                            '$tour_equip_1', '$tour_equip_2', '$tour_equip_3', '$tour_equip_4', '$tour_equip_5', 
                            '$tour_notice', '$tour_innertext');";  
                            //MYSQL

        $new_tour = $pdo->prepare($sql); //將輸入資料轉為文字 避免有心人士利用SQL指令 
        $new_tour->execute();   //執行 SQL

        // --------------------------取得目前新增的揪團編號-------------------------
        $sql = "SELECT tour_no FROM tour where tour_hoster = '$tour_hoster' order by tour_no desc limit 1";  

        $new_tour = $pdo->prepare($sql);
        $new_tour->execute();

        $prodRows = $new_tour->fetchAll(PDO::FETCH_ASSOC); // 轉陣列檔 可取出其值 

        $tour_no = $prodRows[0]['tour_no'];

        echo "揪團編號".$prodRows[0]['tour_no']."<br>";

        // ------------------------------上傳的圖片 以指定檔名存入指定地點 並存入資料庫------------------------------
        
        $fileCount = count($_FILES['upload_tourimg_input']['name']); // 取得檔案上傳數量
        
        for ($i = 0; $i < $fileCount; $i++){
            // 檢查檔案是否上傳成功
            if ($_FILES['upload_tourimg_input']['error'][$i] === UPLOAD_ERR_OK){
                echo'檔案名稱：'.$_FILES['upload_tourimg_input']['name'][$i].'<br>';
                echo'檔案類型：'.$_FILES['upload_tourimg_input']['type'][$i].'<br>';
                echo'檔案大小：'.($_FILES['upload_tourimg_input']['size'][$i] / 1024).'KB<br>';
                echo'暫存名稱：'.$_FILES['upload_tourimg_input']['tmp_name'][$i].'<br>';
                
                // 檢察檔案是否已經存在
                if (file_exists('/images/tour_image/'.$_FILES['upload_tourimg_input']['name'][$i])){
                    echo '已經存在~<br>';
                }else{

                    $dir = "./images/tour_image"; // 存入地點
                        if(file_exists($dir)==false){
                            mkdir($dir);  //make directory
                    }

                    $file = $_FILES['upload_tourimg_input']['tmp_name'][$i]; //檔案暫存位置 檔名
                    
                    $c = $i+1;

                    $dest = $dir."/".$tour_no.'_'.$c.'.jpg'; // 存入MYSQL的檔名

                    // 將檔案移至指定位置(從哪裡,目的地)
                    move_uploaded_file($file, $dest);

                    // 將檔案位置資訊新增至資料庫中
                    $sql = "UPDATE tour
                    set tour_image_$c = '$dest'
                    WHERE tour.tour_no = $tour_no ;";  

                    $new_tour = $pdo->prepare($sql); 
                    $new_tour->execute();   //執行 SQL


                    
                }

            }else{
                echo '錯誤代碼：'.$_FILES['upload_tourimg_input']['error'].'<br>';
            }
        }
        // ------------------------------  會員點數增加 ------------------------------

        $sql = "UPDATE member
                    set mem_point_tourhost = mem_point_tourhost+8000, mem_point = mem_point+8000
                    WHERE mem_no = $tour_hoster ;";  

        $new_tour = $pdo->prepare($sql); 
        $new_tour->execute();   //執行 SQL

        // ------------------------------  揪團主 已審核已通過 ------------------------------

        $sql = "INSERT INTO tour_participate
                     VALUES('$tour_hoster', '$tour_no', '已審核已通過');";  

        $new_tour = $pdo->prepare($sql); 
        $new_tour->execute();   //執行 SQL

        // ------------------------------  導向目前開團頁面 ------------------------------
        
        echo '<p>畫面跳轉中 . . .</p>';

        header("location:./meet2-3.html?tour_no=".$prodRows[0]['tour_no']); 

    }catch (PDOException $e) {
        $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
        $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";	
      }

?>


</body>
</html>