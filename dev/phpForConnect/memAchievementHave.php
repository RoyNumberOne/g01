<?php
$errMsg='';
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    // $sql= "SELECT ma.achievement_no, ma.achievement_date, M.mem_no, M.mem_name, A.achievement_name, A.achievement_image, A.achievement_category
    //             from mem_achievement ma
    //                 join member M on(ma.mem_no = M.mem_no)
    //                 join achievement A on(ma.achievement_no = A.achievement_no)
    //             WHERE ma.mem_no = 10006  -- 之後改變樹
    //             order by ma.achievement_date desc;
    //             ";

    session_start();
    $mem_no = $_SESSION['mem_no'];


// ================================ OWEN 使用區塊 開始 ================================
    $sql="SELECT m.total_post , m.total_host , m.total_join , DATEDIFF(CURDATE(),`mem_build`) 'datediff' from member m where m.mem_no = $mem_no;";

    $pdoStatement = $pdo->query($sql); //執行mySQL指令
    $result = $pdoStatement->fetch(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
    
    $POSTnumber = $result['total_post'];
    $HOSTnumber = $result['total_host'];
    $JOINnumber = $result['total_join'];
    $datediff = $result['datediff'];

    $sql="SELECT a.achievement_no , a.achievement_require, ma.mem_no 
	from achievement a
	left outer join mem_achievement ma on ( a.achievement_no = ma.achievement_no and ma.mem_no = $mem_no)
	group by a.achievement_no , ma.achievement_no;";

    $pdoStatement = $pdo->query($sql); //執行mySQL指令
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列

    // if == 1 代表 是 null 
    // 開團1
    if(is_null($result[0]['mem_no'])==1){
        if($HOSTnumber>=1){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 1) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 開團5
    if(is_null($result[1]['mem_no'])==1){
        if($HOSTnumber>=5){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 2) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 開團10
    if(is_null($result[2]['mem_no'])==1){
        if($HOSTnumber>=10){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 3) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 參團1
    if(is_null($result[3]['mem_no'])==1){
        if($JOINnumber>=1){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 4) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 參團10
    if(is_null($result[4]['mem_no'])==1){
        if($JOINnumber>=10){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 5) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 參團30
    if(is_null($result[5]['mem_no'])==1){
        if($JOINnumber>=30){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 6) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 揪團3
    if(is_null($result[6]['mem_no'])==1){
        if(($JOINnumber+$HOSTnumber)>=3){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 7) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 揪團15
    if(is_null($result[7]['mem_no'])==1){
        if(($JOINnumber+$HOSTnumber)>=15){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 8) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 揪團30
    if(is_null($result[8]['mem_no'])==1){
        if(($JOINnumber+$HOSTnumber)>=30){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 9) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 發文1
    if(is_null($result[9]['mem_no'])==1){
        if($POSTnumber>=1){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 10) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 發文5
    if(is_null($result[10]['mem_no'])==1){
        if($POSTnumber>=5){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 11) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 發文10
    if(is_null($result[11]['mem_no'])==1){
        if($POSTnumber>=10){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 12) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 登入1
    if(is_null($result[12]['mem_no'])==1){
        if($datediff>=0){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 13) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 登入30
    if(is_null($result[13]['mem_no'])==1){
        if($datediff>=29){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 14) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };
    // 登入90
    if(is_null($result[14]['mem_no'])==1){
        if($datediff>=89){
            $sql="INSERT INTO mem_achievement (mem_no , achievement_no) values ( $mem_no , 15) ;";
            $pdoStatement = $pdo->query($sql);
        }
    };



// ================================ OWEN 使用區塊 結束 ================================


$sql="SELECT a.achievement_no, a.achievement_category , a.achievement_name , a.achievement_require , a.achievement_image , ma.mem_no , ma.achievement_date
from achievement a
left outer join mem_achievement ma on ( a.achievement_no = ma.achievement_no and ma.mem_no = $mem_no)
group by a.achievement_no , ma.achievement_no;
";

// $statement = $pdo -> prepare($sql);
// //$statement -> bindValue(":tour_keep_mem" , $mtN); //套用變數
// $statement -> bindValue(":test" ,10008); //套用變數
// $statement ->execute(); //執行mySQL指令

$pdoStatement = $pdo->query($sql); //執行mySQL指令
$result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC); //fetchAll回傳二維陣列
echo(json_encode($result));



}catch(PDOException $e){ // p83.
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>