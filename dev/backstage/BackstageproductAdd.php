<h3>商品 - 新增</h3>
<form id="newProduct" method="post" action="backstageAddProduct.php" >
    <div class="block left">
        <div class="itembox">商品名稱：<input id="product_name" name="product_name" type="text"></div>
        <div class="itembox">商品類別：
            <select id="product_category" name="product_category">
                <option value="機能服飾">機能服飾</option>
                <option value="登山背包">登山背包</option>
                <option value="登山鞋">登山鞋</option>
                <option value="露營裝備">露營裝備</option>
                <option value="登山配件">登山配件</option>
            </select></div>
        <div class="itembox">難度等級：
                    <label><input class="degree_category" type="radio" value="1" name="degree_category">1</label>
                    <label><input class="degree_category" type="radio" value="2" name="degree_category">2</label>
                    <label><input class="degree_category" type="radio" value="3" name="degree_category">3</label>
                    <label><input class="degree_category" type="radio" value="4" name="degree_category">4</label>
        </div>
        <div class="itembox">商品價格：<input id="product_price" name="product_price" type="text"></div>
        <div class="itembox">商品說明：<input id="product_description" name="product_description" type="text"></div>
    </div>
    <div class="block right">
        <div class="itembox">商品圖片：<input id="product_image1" name="product_image1" type="file"></div>
        <div class="itembox">商品圖片：<input id="product_image2" name="product_image2" type="file"></div>
        <div class="itembox">商品圖片：<input id="product_image3" name="product_image3" type="file"></div>
        <div class="itembox">上架狀態：
            <label><input class="product_situation" type="radio" value="1" name="product_situation">直接上架</label>
            <label><input class="product_situation" type="radio" value="0" name="product_situation">先不要上架</label>
        </div>
    </div>
    <button type="button" id="newProductBtnSend">送出</button>
</form>

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