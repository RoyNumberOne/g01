<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>123test</title>
    <link rel="stylesheet" href="./css/common.css">
</head>
<body>
    

<?php
    $errMsg = "";

    try {
        require_once("./connectMeetain.php");
        //抓取會員資訊
        $member_no = 10001;

        $tour_hoster = $member_no;
        
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

        $sql = "INSERT INTO tour(tour_hoster, tour_mountain , tour_title, tour_activitystart, tour_activityend, 
                                tour_end , tour_min_number, tour_max_number, 
                                tour_equip_1, tour_equip_2, tour_equip_3, tour_equip_4, tour_equip_5, 
                                tour_notice, tour_innertext)
                    VALUES ('$tour_hoster', '$tour_mountain' ,'$tour_title', '$tour_activitystart', '$tour_activityend' , 
                            SUBTIME(`tour_activitystart`, '7 0:0:0'), '$tour_min_number', '$tour_max_number', 
                            '$tour_equip_1', '$tour_equip_2', '$tour_equip_3', '$tour_equip_4', '$tour_equip_5', 
                            '$tour_notice', '$tour_innertext');";  
                            //MYSQL

        $new_tour = $pdo->prepare($sql);
        $new_tour->execute();


        //導向頁面
        $sql = "SELECT tour_no FROM tour where tour_hoster = '$tour_hoster' order by tour_no desc limit 1";  

        $new_tour = $pdo->prepare($sql);
        $new_tour->execute();

        $prodRows = $new_tour->fetchAll(PDO::FETCH_ASSOC);

        
        // echo $prodRows[0]['tour_no'];
        echo '<p>畫面跳轉中 . . .</p>';
        
    // window.location.href="./meet2-3.html?tour_no=100024"

    // header("location:helloworld.html");
    // header("loaction:meet2-3.html");
    header("location:./meet2-3.html?tour_no=".$prodRows[0]['tour_no']);

    }catch (PDOException $e) {
        $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
        $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";	
      }
    

      

    // // php 書
    // if(isset($_POST["action"]) && ($_POST["action"]=="add")){
    //     include(""); //匯入連線引入檔 ///////改
    //     $sql_query = "INSERT INTO tour(tour_hoster, tour_title, tour_activitystart, tour_activityend, tour_min_number, tour_max_number, tour_equip_1, tour_equip_2, tour_equip_3, tour_equip_4, tour_equip_5, tour_notice, tour_innertext)
    //                         VALUES ('$tour_hoster', '$tour_title', '$tour_activitystart', '$tour_activityend', '$tour_min_number', '$tour_max_number', '$tour_equip_1', '$tour_equip_2', '$tour_equip_3', '$tour_equip_4', '$tour_equip_5', '$tour_notice', '$tour_innertext');";  //MYSQL
        
    //     $stmt = $db_link -> prepare($sql_query);
    //     $stmt -> bind_param("sssss", $_POST["tour_title"], $_POST["tour_activitystart"], $_POST["tour_activityend"], $_POST[""]);
    //     $stmt -> excute();
    //     $stmt -> close();  //關閉語法
    //     $db_link -> close();  //關閉資料庫

    //     header("Location: data.php");  //重新導回至data.php ///////改
    // }
?>







<script>
    // window.location.href="./meet2-3.html?tour_no=100024"
</script>




 <?php

// //-------------------------------------------upFile >> 資料夾名稱
// foreach($_FILES["upFile"]["error"] as $i => $data){
// 	switch(  $_FILES["upFile"]["error"][$i] ){
// 		case UPLOAD_ERR_OK:
// 			//--------檢查資料夾是否存在
// 			$dir = "images";
// 			if( file_exists($dir) == false){
// 				mkdir($dir); //make directory
// 			}

// 			$from = $_FILES["upFile"]["tmp_name"][$i];
// 			$to = "$dir/" . $_FILES["upFile"]["name"][$i];  //images/smile.gif
// 			copy($from, $to);
// 			echo "上傳成功~<br>";
// 			break;	
// 		case UPLOAD_ERR_INI_SIZE:
// 			echo "上傳檔案太大, 不得超過", ini_get("upload_max_filesize") , "<br>";
// 			break;
// 		case UPLOAD_ERR_FORM_SIZE:
// 			echo "上傳檔案太大, 不得超過", $_POST["MAX_FILE_SIZE"], "<br>";
// 			break;
// 		case UPLOAD_ERR_PARTIAL:
// 			echo "上傳檔案不完整<br>";
// 			break;
// 		case UPLOAD_ERR_NO_FILE:
// 			echo "檔案未選~<br>";
// 			break;	
// 		default: //其它的狀況通常是網站開發或維護人員的事
// 			echo "系統錯誤，請通知維護人員<br>";
// 	}	
// }

?>
<!-- // <form action="fileUploadMany.php" method="post" enctype="multipart/form-data">
//     帳號 <input type="text" name="memId"><br>
//     姓名<input type="text" name="memName"><br>	
//     大頭貼們 <input type="file" name="upFile[]" multiple accept="image/*"><br>
//     (可以選取多個檔案)
//     <input type="submit" value="OK">
// </form>      -->

 <script>
//     window.addEventListener("load", function(){
//         //..................

//         //..................upFile.onchange
//         document.getElementById("upFile").onchange = function(e){
//             let file = e.target.files[0];  //取得file物件

//             let reader = new FileReader(); //建立一個reader物件 
            
//             reader.readAsDataURL(file); //利用reader物件將file的內容讀進來
            
//             reader.onload = function(){ //reader將file內容讀取完畢時
//                 //reader讀到的資料會放到reader.result
//                 document.getElementById("imgPreview").src = reader.result;
//                 console.log(reader.result);
//             }

            
//         }
//     })	
 </script>  



</body>
</html>