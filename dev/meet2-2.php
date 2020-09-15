<?php 

//-------------------------------------------upFile
foreach($_FILES["upFile"]["error"] as $i => $data){
	switch(  $_FILES["upFile"]["error"][$i] ){
		case UPLOAD_ERR_OK:
			//--------檢查資料夾是否存在
			$dir = "images";
			if( file_exists($dir) == false){
				mkdir($dir); //make directory
			}

			$from = $_FILES["upFile"]["tmp_name"][$i];
			$to = "$dir/" . $_FILES["upFile"]["name"][$i];  //images/smile.gif
			copy($from, $to);
			echo "上傳成功~<br>";
			break;	
		case UPLOAD_ERR_INI_SIZE:
			echo "上傳檔案太大, 不得超過", ini_get("upload_max_filesize") , "<br>";
			break;
		case UPLOAD_ERR_FORM_SIZE:
			echo "上傳檔案太大, 不得超過", $_POST["MAX_FILE_SIZE"], "<br>";
			break;
		case UPLOAD_ERR_PARTIAL:
			echo "上傳檔案不完整<br>";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "檔案未選~<br>";
			break;	
		default: //其它的狀況通常是網站開發或維護人員的事
			echo "系統錯誤，請通知維護人員<br>";
	}	
}

?>
<form action="fileUpload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2048">
        帳號 <input type="text" name="memId"><br>
        姓名<input type="text" name="memName"><br>	
        大頭貼 <input type="file" name="upFile"><br>
        大頭貼二 <input type="file" name="upFile2"><br>
        <input type="submit" value="OK">
</form>   

<script type="text/javascript">
window.addEventListener("load", function(){
	//..................

	//..................upFile.onchange
	document.getElementById("upFile").onchange = function(e){
		let file = e.target.files[0];  //取得file物件

		let reader = new FileReader(); //建立一個reader物件 
		
		reader.readAsDataURL(file); //利用reader物件將file的內容讀進來
		
		reader.onload = function(){ //reader將file內容讀取完畢時
			//reader讀到的資料會放到reader.result
			document.getElementById("imgPreview").src = reader.result;
			console.log(reader.result);
		}

		
	}
})	
</script>  