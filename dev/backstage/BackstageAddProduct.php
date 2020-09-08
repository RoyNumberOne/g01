<?php

try {
	require_once ('connectMeetain.php');
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $degree_category = $_POST['degree_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_situation = $_POST['product_situation'];

    if( file_exists("../images/product_image")== false ){
        mkdir("../images/product_image");  // make dictionary
    }
	$product_imgpath[] = array();
    if(is_array($_FILES)) {
        for($i=0;$i<3;$i++){
            if(is_uploaded_file($_FILES["upFile"]["tmp_name"][$i])) {
                $sourcePath = $_FILES["upFile"]["tmp_name"][$i];
                $targetPath = "./images/product_image/".$product_name.$i;    
                // $targetPath = "../images/product_image/".$_FILES["upFile"]["name"][$i];        
        		array_push($product_imgpath,$targetPath);
                // $product_image0=$targetPath;
            if(move_uploaded_file($sourcePath,('.'.$targetPath))) {
                }
            }
        }
    }
    
	$sql = "INSERT INTO product (product_name,product_category,degree_category,product_price,product_description,product_image1,product_image2,product_image3,product_situation)
    VALUES ('$product_name', '$product_category','$degree_category','$product_price','$product_description','$product_imgpath[1]','$product_imgpath[2]','$product_imgpath[3]','$product_situation');";
	$pdoStatement = $pdo->query($sql);
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

$sql = null;
?>