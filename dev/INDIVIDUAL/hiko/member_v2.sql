-- 會員收藏討論文章，由新到舊排序
select fk.forum_keep_mem'誰收藏', fk.forum_iskept_post'收藏哪篇' ,fp.forum_post_no'討論文章編號' ,fp.forum_post_title'討論文標題' ,fp.forum_post_image'討論文圖片' ,fp.forum_post_innertext'討論文內文' ,fp.forum_post_time'發文時間' 
	from forum_keep fk 
    	join forum_post fp on(fk.forum_iskept_post = fp.forum_post_no)
    WHERE fk.forum_keep_mem = 10008  -- 之後改變數
    order BY fp.forum_post_time DESC;


-- 會員收藏揪團行程，由新到舊排序
select tk.tour_keep_mem'誰收藏', tk.tour_iskept_tour'收藏哪團', T.tour_no'揪團編號', T.tour_image_1'圖片上傳1', T.tour_title'揪團文標題', T.tour_innertext'活動簡介', T.tour_build'建立時間'
	from tour_keep tk
		join tour T on(tk.tour_iskept_tour = T.tour_no)
	WHERE tk.tour_keep_mem = 10008  -- 之後改變數
    order BY T.tour_build DESC;

-- 會員收藏商品品項，由編號小到大排序
select pk.product_keep_mem'誰收藏', pk.product_iskept_no'收藏哪項', P.product_no'商品編號', P.product_image1'商品圖1', P.product_name'商品名稱', P.product_description'商品說明'
	from product_keep pk
		join product P on(pk.product_iskept_no = P.product_no)
        WHERE pk.product_keep_mem = 10008  -- 之後改變數and
        order BY P.product_no DESC; -- 因為沒有建立日期所以用編號排序