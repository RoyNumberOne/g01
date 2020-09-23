<?php
$errMsg = "";
try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    
    session_start();
    $mem_no = $_SESSION['mem_no'];

    $sql= "SELECT m.mem_no, mr.mem_no, mr.mem_realname_situation, mg.mem_no, mg.mem_guide_situation
                from member_realname mr
                    join member m on(mr.mem_no = m.mem_no)
                    join member_guide mg on(m.mem_no = mg.mem_no)
                where m.mem_no = $mem_no;
                ";

    // $statement = $pdo -> prepare($sql);
    // //$statement -> bindValue(":forum_keep_mem" , $mtN); //套用變數
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