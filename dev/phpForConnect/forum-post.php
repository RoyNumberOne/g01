<?php
try{
//前端送來的資料
    // require_once("./connectMeetain.php");
    
    // $sql = "select * from `member` where mem_acc=:mem_acc or mem_id=:mem_id";
    // $mem_id = $_POST['mem_id'];
    // $mem_acc = $_POST['mem_acc'];
    // $member = $pdo->prepare($sql);
    // $member->bindValue(":mem_acc", $mem_acc);
    // $member->bindValue(":mem_id", $mem_id);
    // $member ->execute();
// 判斷帳號是否使用過

    //發文

    // if( $member->rowCount() !=0){
    //     echo "此帳號或暱稱已申請過"; //
    // }else{
        $forum_post_category = $_POST['forum_post_category'];
        $forum_post_title = $_POST['forum_post_title'];
        $forum_post_image = $_POST['forum_post_image'];
        $forum_post_innertext = $_POST['forum_post_innertext'];

        $sql = "INSERT INTO forum_post ( forum_post_poster_forum_post_category, forum_post_image,  forum_post_title, forum_post_innertext)
        
        VALUES ('$forum_post_category','$forum_post_title', '$forum_post_image','$forum_post_innertext');";
        $pdoStatement = $pdo->query($sql);

        echo "感謝您的發文";
    // }

}catch(PDOException $e){
    echo $e->getMessage();
}
?>