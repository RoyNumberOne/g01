<?php
session_start();
try{
    require_once("./connectMeetain.php");
    $sql = "select m.* , guide_no , mem_idno from `member` m left outer join `member_guide` mg on (m.mem_no = mg.mem_no and mem_guide_situation = '已審核已通過') left outer join member_realname mr on (m.mem_no = mr.mem_no and mem_realname_situation = '已審核已通過') where mem_acc=:mem_acc and mem_psw=:mem_psw;"; 
    $member = $pdo->prepare($sql);
    // $member->bindValue(":mem_acc", $_GET["mem_acc"]);
    // $member->bindValue(":mem_psw", $_GET["mem_psw"]);
    $member->bindValue(":mem_acc", $_POST["mem_acc"]);
    $member->bindValue(":mem_psw", $_POST["mem_psw"]);
    $member->execute();
  
    if( $member->rowCount()==0){ //查無此人
        echo "{}";
    }else{ //登入成功
      //自資料庫中取回資料
        $memRow = $member->fetch(PDO::FETCH_ASSOC);
  
        //將登入者的資料先寫入session
        $_SESSION["mem_no"] = $memRow["mem_no"];
        $_SESSION["mem_id"] = $memRow["mem_id"];
        $_SESSION["mem_name"] = $memRow["mem_name"];
        $_SESSION["mem_acc"] = $memRow["mem_acc"];
        $_SESSION["mem_psw"] = $memRow["mem_psw"];
        $_SESSION["mem_mail"] = $memRow["mem_mail"];
        $_SESSION["mem_build"] = $memRow["mem_build"];
        $_SESSION["mem_point"] = $memRow["mem_point"];
        $_SESSION["mem_avator"] = $memRow["mem_avator"];
        $_SESSION["mem_bg"] = $memRow["mem_bg"];
        $_SESSION["class"] = $memRow["class"];
        $_SESSION["guide_no"] = $memRow["guide_no"];
        $_SESSION["mem_idno"] = $memRow["mem_idno"];
        $_SESSION["mem_badge1"] = $memRow["mem_badge1"];
        $_SESSION["mem_badge2"] = $memRow["mem_badge2"];
        $_SESSION["mem_badge3"] = $memRow["mem_badge3"];
        $_SESSION["ban_forum_date"] = $memRow["ban_forum_date"];
        $_SESSION["ban_tour_date"] = $memRow["ban_tour_date"];
        $_SESSION["ban_comment_date"] = $memRow["ban_comment_date"];
  
      //送出登入者的姓名資料
      $result = array("mem_no"=>$memRow["mem_no"], 
                    "mem_id"=>$memRow["mem_id"],
                    "mem_name"=>$memRow["mem_name"],
                    "mem_acc"=>$memRow["mem_acc"],
                    "mem_psw"=>$memRow["mem_psw"],
                    "mem_mail"=>$memRow["mem_mail"],
                    "mem_build"=>$memRow["mem_build"],
                    "mem_point"=>$memRow["mem_point"],
                    "mem_avator"=>$memRow["mem_avator"],
                    "mem_bg"=>$memRow["mem_bg"],
                    "class"=>$memRow["class"],
                    "guide_no"=>$memRow["guide_no"],
                    "mem_idno"=>$memRow["mem_idno"],
                    "mem_badge1"=>$memRow["mem_badge1"],
                    "mem_badge2"=>$memRow["mem_badge2"],
                    "mem_badge3"=>$memRow["mem_badge3"],
                    "ban_forum_date"=>$memRow["ban_forum_date"],
                    "ban_tour_date"=>$memRow["ban_tour_date"],
                    "ban_comment_date"=>$memRow["ban_comment_date"]);
    

      echo json_encode($result);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
  ?>