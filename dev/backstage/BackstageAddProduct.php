<?php
try {
	require_once ('connectMeetain.php');
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $degree_category = $_POST['degree_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image1 = $_POST['product_image1'];
    $product_image2 = $_POST['product_image2'];
    $product_image3 = $_POST['product_image3'];
    $product_situation = $_POST['product_situation'];
	
	$sql = "INSERT INTO product (product_name,product_category,degree_category,product_price,product_description,product_image1,product_image2,product_image3,product_situation)
    VALUES ('$product_name', '$product_category','$degree_category','$product_price','$product_description','default','default','default','$product_situation');";
	$pdoStatement = $pdo->query($sql);
	// $pdoStatement = $pdo->exec($sql);
	// $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

    // $pdo->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

$sql = null;
?>