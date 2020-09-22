

<?php
    $errMsg = "";
    //加這段php404的問題會被解決,但畫面不會跳轉
    // header('HTTP/1.1 404 Not Found');
    // header("status: 404 Not Found");
    
    try{
        header("connect-type: text/html; charset=utf-8");
        require_once("./connectMeetain.php");

        //抓取會員資訊  ----> 這段測試打開PHP會出現錯誤訊息
        session_start();
        $forum_post_poster = $_SESSION['mem_no'];
        echo $forum_post_poster;
        // $member_no = $_SESSION["mem_no"];

        //會員資料 ---->要開啟才可以run
        // $member_no = 10003;
        // $forum_post_poster = $member_no;

        //前端送來的資料
        //會接收HTML中select的選項的VALUE
        $forum_post_category = $_POST['forum_post_category']; 
        $forum_post_title = $_POST['forum_post_title'];
        $forum_post_innertext = $_POST['forum_post_innertext'];
        // $forum_post_image = $_POST['forum_post_image']; //image另外寫
        $sql = "INSERT INTO forum_post(         
                    forum_post_poster,
                    forum_post_category, 
                    forum_post_title, 
                    forum_post_innertext)
                VALUES (
                    '$forum_post_poster',
                    '$forum_post_category',
                    '$forum_post_title',
                    '$forum_post_innertext');";
                
        $new_forum_post = $pdo->prepare($sql); 
        $new_forum_post->execute();
        
        echo '感謝您的發文';

        // --------取得發文者編號-RUN SQL -->有一個值-------
        $sql = "SELECT forum_post_no from forum_post where forum_post_poster = '$forum_post_poster' order by forum_post_no desc limit 1";

        $new_forum_post = $pdo->prepare($sql); 
        $new_forum_post->execute(); //原先這段有註解

        $prodRows = $new_forum_post->fetchAll(PDO::FETCH_ASSOC);

        $forum_post_no = $prodRows[0]['forum_post_no'];

        echo "發文者編號".$prodRows[0]['forum_post_no']."<br>";

        // -------------------------上傳的圖片 以指定檔名存入指定地點 並存入資料庫-------------------------

        if ($_FILES['forum_post_image']['error'] === UPLOAD_ERR_OK){
            echo'檔案名稱：'.$_FILES['forum_post_image']['name'].'<br>';
            echo'檔案類型：'.$_FILES['forum_post_image']['type'].'<br>';
            echo'檔案大小：'.($_FILES['forum_post_image']['size']/ 1024).'KB<br>';
            echo'暫存名稱：'.$_FILES['forum_post_image']['tmp_name'].'<br>';
            
            // 檢查檔案是否已經存在
            // if (file_exists('/images/forum_image/'.$_FILES['forum_post_image']['name'])){
            //     echo '已經存在~<br>';
            // }else{

                $dir = "../images/forum_image"; // 存入地點 本機端
                $dir2 = "./images/forum_image"; // 存入地點 SQL


                // //     if(file_exists($dir)==false){
                // //         mkdir($dir);  //make directory
                // // }

                $file = $_FILES['forum_post_image']['tmp_name']; //檔案暫存位置 檔名
                $dest = $dir."/".$forum_post_no.'.jpg'; // 存入的檔名
                
                $dest2 = $dir2."/".$forum_post_no.'.jpg'; // 存入的檔名

                //這段要再確認是否是這樣寫
                
                // 將檔案移至指定位置 -- 無法使用
                // move_uploaded_file($file, $dest);
                // 將檔案移至指定位置 -- 可使用
                copy($file, $dest);
                    
                // // 將檔案位置資訊新增至資料庫中
                $sql = "UPDATE forum_post
                set forum_post_image = '$dest2' 
                WHERE forum_post.forum_post_no = $forum_post_no ;";  

                $new_forum_post = $pdo->prepare($sql); 
                $new_forum_post->execute();   //執行 SQL             
            // }

            // }else{
            //     echo '錯誤代碼：'.$_FILES['forum_post_image']['error'].'<br>';



        // ------------- 會員點數增加(數字再確認) -------------

            $sql = "UPDATE member
            set mem_point_forumpost = ( `mem_point_forumpost`+8000) , mem_point = (`mem_point` + 8000) , total_post = (`total_post` + 1)
            WHERE mem_no = $forum_post_poster ;";  

            $new_tour = $pdo->prepare($sql); 
            $new_tour->execute();   //執行 SQL
    

        header("location:../forum-comment.html?forum_post_no=".$forum_post_no);
    }
    }catch(PDOException $e){
            $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
            $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
            echo $errMsg;
        }

?>
    