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
                <span id="loadButton_1" style="background-color:#2C5E9E; color:#FFF"><a href="./Backstageproduct.php">已上架</a></span>
                <span id="loadButton_2"><a href="./Backstageproduct0.php">未上架</a></span>
                <button type="submit" class="btnB_L_yellow_2" id="loadButton_3"><p>新增</p><div class="bg2"></div></button>
            </div>
            <div id="ccc">
                <h3>商品 - 已上架</h3>
                <?php
                try	{
                    require_once('connectMeetain.php');
                        // pag ===========================
                        $sql = "select count(*) totalCount from product where product_situation= 1";
                        $stmt = $pdo->query($sql); 
                        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                        $totalRecords = $row["totalCount"]; 
                        // echo $totalRecords;
                        $recPerPage= 5;
                        $totalPages = ceil($totalRecords / $recPerPage);
                        $pageNo = isset($_GET["pageNo"]) ? $_GET["pageNo"] : 1;
                        $start = ($pageNo-1) * $recPerPage; 
                        // pag ===========================
                        
		                $sql = "SELECT product_no '商品編號' , degree_category '難度等級' , product_category '商品分類' , product_name '商品名稱' , product_price '商品價格' , product_description '商品說明' , product_image1 '商品圖片一' , product_image2 '商品圖片二' , product_image3 '商品圖片三' , product_situation '商品狀態' 
                                    from product where product_situation = 1 limit $start,$recPerPage"; //$recPerPage 每頁幾筆資料
                        $pdoStatement = $pdo->query($sql);
                        $prodRows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table>
                        <tr class='cyan'><th width="80px">商品編號</th><th style="width:60px;">難度等級</th><th width="100px">商品分類</th><th width="160px">商品名稱</th><th width="80px">商品價格</th><th style="width:200px;">商品說明</th><th width="100px">商品圖片一</th><th width="100px">商品圖片二</th><th width="100px">商品圖片三</th><th></th></tr>
                        <?php
                        foreach ( $prodRows as $i => $prodRow){
                        ?>
                            <tr>
                            <td class='pink'>
                                <a href="../product_info.html?productNo=<?=$prodRow["商品編號"]?>" style="color:#555555;">
                                <?=$prodRow["商品編號"]?></a>
                                <input type="checkbox" name="productAUTH<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品狀態"]?>'>
                            </td>
                            <td style="width:20px;"><?=$prodRow["難度等級"]?></td>
                            <td style="width:150px;"><?=$prodRow["商品分類"]?></td>
                            <td><input type="text" name="productNAME<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品名稱"]?>'></td>
                            <td><input type="text" name="productPRICE<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品價格"]?>'style="width:60px;"></td>
                            <td><input type="text" name="productDESC<?=$prodRow["商品編號"]?>" disabled value='<?=$prodRow["商品說明"]?>'></td>
                            <td><img src="<?='.'.$prodRow["商品圖片一"]?>" width="100px" alt=""></td>
                            <td><img src="<?='.'.$prodRow["商品圖片二"]?>" width="100px" alt=""></td>
                            <td><img src="<?='.'.$prodRow["商品圖片三"]?>" width="100px" alt=""></td>
                            <td><label><input name="<?=$prodRow["商品編號"]?>" type="button" value="修改" class="editproduct"></label></td>
                            </tr>
                            <script>
                                function checkProductAuth(){
                                    if ( <?=$prodRow["商品狀態"]?> == 1 ){
                                        $("input[name='productAUTH<?=$prodRow["商品編號"]?>'").prop("checked","checked");
                                    }
                                }
                                    checkProductAuth();
                            </script>
                            <?php } ?>
                        </table>
                    <?php
                    }	catch	(PDOException $e)	{
                    }
                ?>
                
                <div class="pagebtn">
                    <?php 
                        for($i=1; $i<=$totalPages; $i++){
                        echo "<a href='Backstageproduct.php?pageNo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
                        }
                    ?>
                </div>
            </div>    
        </div>
    </section>

</main>
<script>
	// 商品修改 － 上架中
	$(Document).ready(function(){
		$(".editproduct").click(function(){
			if ($(this).val() == '修改'){
				$(this).prop('value', '儲存');
				$(this).parent().parent().siblings().children().removeAttr("disabled");
			}	else	{
				var temp = $(this).attr('name');
				let EDITproduct_name = $("input[name='productNAME"+temp+"']").val();
				let EDITproduct_price = $("input[name='productPRICE"+temp+"']").val();
				let EDITproduct_description = $("input[name='productDESC"+temp+"']").val();
				let EDITproduct_situation = $("input[name='productAUTH"+temp+"']").val();
				
				// console.log(EDITproduct_situation);
				$.ajax({
					url: './BackstageEditProduct.php',
					data: {	product_no: temp,
							EDITproduct_name: EDITproduct_name ,
							EDITproduct_price:EDITproduct_price,
							EDITproduct_description:EDITproduct_description,
							EDITproduct_situation:EDITproduct_situation
						},
					type: 'POST',   
					success(){
					} ,
				});

				$(this).prop('value', '修改');
				$(this).parent().parent().siblings().children().prop("disabled","disabled");
			}
		})
	})
</script>
<script>
// checkbox 切換更動 value
$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
});
</script>

<script>
$(Document).ready(function(){
    let url = new URL(window.location.href);
    // console.log(url);
    let curPage = new URLSearchParams(url.search);
    curPage = curPage.get("pageNo") - 1;
    // console.log(curPage);
    if (curPage == -1) { curPage = 0}
    // console.log(curPage);
    $(".pagebtn").children().eq(curPage).children().addClass('-active')
});
</script>
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
<script src="./js/backstage.js"></script>
</body>
</html>