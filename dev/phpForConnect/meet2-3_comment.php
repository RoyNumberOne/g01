<?php
$errMsg = "";

try{
    header("connect-type: text/html; charset=utf-8");
    
    require_once('./connectMeetain.php');
    $tour_no = $_REQUEST['tour_no'];
    // $sql = "SELECT c.*, m.* FROM comment_post c join member m on c.comment_poster = m.mem_no where c.comment_class = '揪團區' and tour_post_no = $tour_no";
    $sql = "SELECT cp.comment_no, cp.comment_poster, cp.comment_class, cp.tour_post_no, cp.comment_time, cp.comment_innertext, cp.comment_situation,
	m.mem_no, m.mem_id, m.mem_avator, m.mem_bg, m.mem_badge1, a1.achievement_image 'badge1', m.mem_badge2, a2.achievement_image 'badge2', m.mem_badge3, a3.achievement_image 'badge3',
    mg.guide_no , mr.mem_realname
    FROM comment_post cp 
    LEFT OUTER JOIN member m ON cp.comment_poster = m.mem_no 
    LEFT OUTER JOIN achievement a1 ON m.mem_badge1 = a1.achievement_no
    LEFT OUTER JOIN achievement a2 ON m.mem_badge2 = a2.achievement_no
    LEFT OUTER JOIN achievement a3 ON m.mem_badge3 = a3.achievement_no
    LEFT OUTER JOIN member_guide mg ON (m.mem_no = mg.mem_no AND mg.mem_guide_situation = '已審核已通過')
    LEFT OUTER JOIN member_realname mr ON (m.mem_no = mr.mem_no and mr.mem_realname_situation = '已審核已通過')
    WHERE cp.comment_class='揪團區' AND cp.tour_post_no = $tour_no AND cp.comment_situation = 1
    ORDER BY cp.comment_time";

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement = $pdo->query($sql);
    // $pdoStatement->bindValue(":tour_no", 100001);
    // $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($result));
    
}catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
    }
?>