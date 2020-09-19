<?php
session_start();
try{
    require_once("./connectMeetain.php");
    $sql = "select * from `member` where mem_acc=:mem_acc and mem_psw=:mem_psw"; 
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
                    "class"=>$memRow["class"]);
    

      echo json_encode($result);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
  ?>