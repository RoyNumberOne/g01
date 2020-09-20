<?php
session_start();
try{
    require_once('connectMeetain.php');
    $mem_no = $_SESSION['mem_no'];
    if ($_FILES['mem_ava_edit']['error'] ==0){
        echo'檔案名稱：'.$_FILES['mem_ava_edit']['name'].'<br>';
        echo'檔案類型：'.$_FILES['mem_ava_edit']['type'].'<br>';
        echo'檔案大小：'.($_FILES['mem_ava_edit']['size']/ 1024).'KB<br>';
        echo'暫存名稱：'.$_FILES['mem_ava_edit']['tmp_name'].'<br>';

        $dir = "../images/avator_image"; // 存入地點 本機端
        $dir2 = "./images/avator_image"; // 存入地點 SQL


        $file = $_FILES['mem_ava_edit']['tmp_name']; //檔案暫存位置 檔名
        $dest = $dir."/".$mem_no.'.jpg'; // 存入的檔名
        
        $dest2 = $dir2."/".$mem_no.'.jpg'; // 存入的檔名


        copy($file, $dest); 
        // // 將檔案位置資訊新增至資料庫中
        $sql = "UPDATE member
        set mem_avator = '$dest2' 
        WHERE member.mem_no = $mem_no ;"; 

        $member = $pdo->prepare($sql); 
        $member ->execute();   //執行 SQL
    }   

}catch(PDOException $e){
    $e -> getMessage();

}
?>