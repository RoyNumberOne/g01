<h3>商品 - 未上架</h3>
<?php
try	{
	require_once('connectMeetain.php');

		//算出有幾「 筆 」（取得總比數）
		$sql = "select count(*) totalCount from product where product_situation=0";
		$stmt = $pdo->query($sql); 
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
		$totalRecords = $row["totalCount"]; 
		//每頁要印幾筆
		$recPerPage= 5;
		
		//算出有幾頁 總筆數/我每頁要印的東西
		$totalPages = ceil($totalRecords / $recPerPage);
		$pageNoo = isset($_GET["pageNoo"]) ? $_GET["pageNoo"] : 1;
		$start = ($pageNoo-1) * $recPerPage; 
		$sql = "SELECT product_no '商品編號' , degree_category '難度等級' , product_category '商品分類' , product_name '商品名稱' , product_price '商品價格' , product_description '商品說明' , product_image1 '商品圖片一' , product_image2 '商品圖片二' , product_image3 '商品圖片三' from product where product_situation=0 limit $start,$recPerPage";
		$products = $pdo->query($sql);
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
		echo "<a href='BackstageProduct.php?pageNoo=$i'><button class=\"btnA_S pg\"`><p>$i</p></button></a>&nbsp;&nbsp;";
		}
	?>
</div>