<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>發表文章GO</title>
    <link rel="stylesheet" href="../css/common.css">
</head>
<body>

<?php
    $errMsg = "";
    
    try{
        require_once("./connectMeetain.php");
        //會員資料
        $member_no = 10003;
        $forum_post_poster = $member_no;

        //發文者
        // if( $member->rowCount() !=0){
        //     echo "此帳號或暱稱已申請過"; //
        // }else{

            //前端送來的資料
        $forum_post_category = $_POST['forum_post_category']; 
        //會接收HTML中select的選項的VALUE
        $forum_post_title = $_POST['forum_post_title'];
        $forum_post_image = $_POST['forum_post_image'];
        $forum_post_innertext = $_REQUEST['forum_post_innertext'];


        $sql = "INSERT INTO forum_post(         
                    forum_post_poster,
                    forum_post_category, 
                    -- forum_post_image,  
                    forum_post_title, 
                    forum_post_innertext)
                VALUES (
                    '$forum_post_poster',
                    '$forum_post_category',
                    -- '$forum_post_image', 
                    '$forum_post_title',
                    '$forum_post_innertext');";
                
        $new_forum_post = $pdo->query($sql);
        // $new_forum_post->execute($sql);
        
        echo '123';
        
        //導向頁面 ---RUN SQL ---> NLL
        // $sql = "SELECT forum_post_no from forum_post where forum_post_poster = '$forum_post_poster' order by forum_post_no desc limit 1";

        // $new_forum_post = $pdo->query($sql);
        // $new_forum_post->execute();

        // $prodRows = $new_forum_post->fetchAll(PDO::FETCH_ASSOC);

        // echo '<p>感謝您的發文</p>';

        // header("location:./forum-comment.html?forum_post_no=".$prodRows[0]['forum_post_no']
        //);
    // }

        }catch(PDOException $e){
            $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
            $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";	
            echo $errMsg;
        }

?>
    
</body>
</html>