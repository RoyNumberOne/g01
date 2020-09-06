<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>媒山友後台管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0all.min.css">
    <link rel=“stylesheet” href="./css/fa5.14.0v4.min.css">
    <link rel="stylesheet" href="../css/Backstagemain.css">
    <link rel="stylesheet" href="../css/BackstageHeader.css">
    <link rel="stylesheet" href="../css/Backstageproduct.css">
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./js/fa5.14.0all.js"integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="crossorigin="anonymous"></script>
</head>
<body>
<main>
    <?php
        require_once("./BackstageHeader.inc");
    ?>
    <aside>
    <?php
        require_once("./BackstageNav.inc");
    ?>        
    </aside>
    <section>
        <div>
            <div class="product_total">
                <h4>商品管理</h4>
                    <span id="loadButton_1" 
                    <?php if($_REQUEST["name"]==1){
                        echo 'style="background-color:#2C5E9E; color:#FFF"';
                    }
                    ?>
                    ><a href="BackstageProduct.php?pageNo=1&name=1">上架中</a></span>
                    <span id="loadButton_2"
                    <?php if($_REQUEST["name"]==0){
                        echo 'style="background-color:#2C5E9E; color:#FFF"';
                    }
                    ?>
                    ><a href="BackstageProduct.php?pageNo=1&name=0">未上架</a></span>
                    <button type="submit" class="btnB_L_yellow_2" id="loadButton_3"><p>新增</p><div class="bg2"></div></button>
            </div>
            <div id="ccc">
                <h3>
                <?php if($_REQUEST["name"]==1){echo '商品 - 上架中';}?>
                <?php if($_REQUEST["name"]==0){echo '商品 - 未上架';}?>
                </h3>
                <?php
                $name =  $_REQUEST["name"];
                try	{
                    require_once('connectMeetain.php');
                        $sql = "select count(*) totalCount from product where product_situation=:situation";
                        $stmt = $pdo->prepare($sql); 
                        $stmt -> bindValue(":situation",$name);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                        $totalRecords = $row["totalCount"]; 
                        // echo $totalRecords;
                        $recPerPage= 5;
                        
                        $totalPages = ceil($totalRecords / $recPerPage);
                        $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                        $start = ($pageNo-1) * $recPerPage; 
                        $sql = "SELECT product_no '商品編號' , degree_category '難度等級' , product_category '商品分類' , product_name '商品名稱' , product_price '商品價格' , product_description '商品說明' , product_image1 '商品圖片一' , product_image2 '商品圖片二' , product_image3 '商品圖片三' from product where product_situation=:situation limit $start,$recPerPage";
                        $products = $pdo->prepare($sql); 
                        $products -> bindValue(":situation",$name);
                        $products->execute();
                        $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table>
                        <tr class='cyan'><th width="80px">商品編號</th><th width="100px">難度等級</th><th width="100px">商品分類</th><th width="160px">商品名稱</th><th width="80px">商品價格</th><th width="300px">商品說明</th><th width="100px">商品圖片一</th><th width="100px">商品圖片二</th><th width="100px">商品圖片三</th></tr>
                        <?php
                        foreach ( $prodRows as $i => $prodRow){
                        ?>
                            <tr>
                            <td class='pink'><?=$prodRow["商品編號"]?></td>
                            <td><?=$prodRow["難度等級"]?></td>
                            <td><?=$prodRow["商品分類"]?></td>
                            <td><?=$prodRow["商品名稱"]?></td>
                            <td><?=$prodRow["商品價格"]?></td>
                            <td style="overflow:hidden;
                                        white-space: nowrap;
                                        text-overflow: ellipsis;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        white-space: normal;">
                                        <?=mb_substr($prodRow["商品說明"],0,25)?></td>
                            <td><?=$prodRow["商品圖片一"]?></td>
                            <td><?=$prodRow["商品圖片二"]?></td>
                            <td><?=$prodRow["商品圖片三"]?></td>
                            <td style="background-color: #eaf1f4;" ><button type="submit" class="btnB_L_yellow">
                            <p>修改</p>
                            <div class="bg"></div>
                            </button></td>
                            </tr>

                            <?php } ?>
                        </table>
                    <?php
                    }	catch	(PDOException $e)	{
                    }
                ?>
                <div class="pagebtn">
                    <?php 
                        for($i=1; $i<=$totalPages; $i++){
                        echo "<a href='BackstageProduct.php?pageNo=$i&name=$name'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                        }
                    ?>
                </div>
            </div>    
        </div>
    </section>

</main>
<script>
//load php
    $('#loadButton_1').click(function () {
        // $('#ccc').load('Backstageproduct.php',{ name:'1' });
        $('#loadButton_1').css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
    $('#loadButton_2').click(function () {
        // $('#ccc').load('BackstageProduct.php',{ name:'0' });
        $('#loadButton_2').css({"background-color":"#2C5E9E","color":"#FFF"});
        $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
    $('#loadButton_3').click(function () {
        $('#ccc').load('BackstageproductAdd.php');
        $('.btnB_L_yellow_2 ::after').css({"border":"#ff7372 4px solid"});
        $('.bg2').css({"background-color":"#ff7372","color":"#FFF"});
        $('#loadButton_2').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
        $('#loadButton_1').css({"background-color":"#eaf1f4","color":"#2C5E9E"});
    });
</script>
<script>
	// 商品 - 新增
	$(Document).ready(function(){
		$("#newProductBtnSend").click(function(){
			let product_name = $("#product_name").val();
			let product_category = $("#product_category").val();
			let degree_category = $(".degree_category:checked").val();
			let product_price = $("#product_price").val();
			let product_description = $("#product_description").val();
			let product_image1 = $("#product_image1").val();
			let product_image2 = $("#product_image2").val();
			let product_image3 = $("#product_image3").val();
			let product_situation = $(".product_situation:checked").val();
			$.post("./backstageAddProduct.php",
				{product_name: product_name,
				product_category: product_category,
				degree_category: degree_category,
				product_price: product_price,
				product_description: product_description,
				product_image1: product_image1,
				product_image2: product_image2,
				product_image3: product_image3,
				product_situation: product_situation
				},
				function(){
				//要導去另外正確頁面
				window.location.reload(true);
			})
        })
	})
</script>
<script src="./js/backstage.js"></script>
</body>
</html>