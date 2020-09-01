<!-- <h3>商品 - 新增</h3> -->
<form id="newProduct" method="post" action="backstageAddProduct.php" >
<div id="newwProduct">
    <div class="block left">
            <div class="itembox">商品名稱：<input id="product_name" name="product_name" type="text" required></div>
            <div class="itembox">商品類別：
                <select id="product_category" name="product_category" required>
                    <option value="機能服飾">機能服飾</option>
                    <option value="登山背包">登山背包</option>
                    <option value="登山鞋">登山鞋</option>
                    <option value="露營裝備">露營裝備</option>
                    <option value="登山配件">登山配件</option>
                </select></div>
            <div class="itembox">難度等級：
                <label><input class="degree_category" type="radio" value="1" name="degree_category" checked>1</label>
                <label><input class="degree_category" type="radio" value="2" name="degree_category">2</label>
                <label><input class="degree_category" type="radio" value="3" name="degree_category">3</label>
                <label><input class="degree_category" type="radio" value="4" name="degree_category">4</label>
            </div>
            <div class="itembox">商品價格：<input id="product_price" name="product_price" type="text" required></div>
            <div class="itembox">商品說明：<textarea name="product_description" id="product_description" style="resize:none;width:185px;height:150px;" required></textarea></div>
        </div>
        <div class="block right">
            <div id="pro_image">
                <label for="product_image1"><img src="../images/icons/icon_2-2scstep_1.svg" id="pro_image1" style="opacity: 0.3;"></label>
                <label for="product_image2"><img src="../images/icons/icon_2-2scstep_2.svg" id="pro_image2" style="opacity: 0.3;"></label>
                <label for="product_image3"><img src="../images/icons/icon_2-2scstep_3.svg" id="pro_image3" style="opacity: 0.3;"></label>
            </div>
            <label for="product_image1">商品圖片一：
                <img src="../images/icons/icon_photo.svg">
            </label><br>
            <input type="file" name="product_image1" id="product_image1" style="opacity: 0;margin:0px;height: 1px;" required><br>
            <label for="product_image2">商品圖片二：
                <img src="../images/icons/icon_photo.svg">
            </label><br>
            <input type="file" name="product_image2" id="product_image2" style="opacity: 0;margin:0px;height: 1px;" required><br>
            <label for="product_image3">商品圖片三：
                <img src="../images/icons/icon_photo.svg">
            </label><br>
            <input type="file" name="product_image3" id="product_image3" style="opacity: 0;margin:0px;height: 1px;" required><br>
            <div class="itembox">上架狀態：
                <label><input class="product_situation" type="radio" value="1" name="product_situation" checked>直接上架</label>
                <label><input class="product_situation" type="radio" value="0" name="product_situation">先不要上架</label>
            </div>
        </div>
    </div>    
    <button type="button" id="newProductBtnSend">送出</button>
</form>
<script>

$("#product_image1").change(function(){
  readURL(this);

});
$("#product_image2").change(function(){
  readURL2(this);

});
$("#product_image3").change(function(){
  readURL3(this);

});

function readURL(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function (e) {
       $("#pro_image1").attr('src', e.target.result);
       $("#pro_image1").css("opacity","1");
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function readURL2(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function (e) {
       $("#pro_image2").attr('src', e.target.result);
       $("#pro_image2").css("opacity","1");
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function readURL3(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function (e) {
       $("#pro_image3").attr('src', e.target.result);
       $("#pro_image3").css("opacity","1");
    }
    reader.readAsDataURL(input.files[0]);
  }
}

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