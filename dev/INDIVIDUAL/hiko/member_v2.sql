
-- 會員已完成的揪團，由出團時間近到遠排序
select tp.tour_participate_mem'誰參加', tp.tour_participate_tour'參加哪團', T.tour_no'揪團編號',T.tour_progress'揪團狀態', T.tour_activitystart'活動開始日期', T.tour_activityend'活動結束日期', M.mountain_image'山的圖片', M.mountain_area'山的地區', M.mountain_name'山的名字', M.degree_category'山的難度'
	from tour_participate tp
		join tour T on(tp.tour_participate_tour = T.tour_no)
        join mountain M on(T.tour_mountain = M.mountain_no)
	WHERE tp.tour_participate_mem = 10009 -- 之後改變數
	and T.tour_progress = '已結束' 
	and M.mountain_area = 'south'
	order BY T.tour_activitystart DESC;

-- 會員已完成的揪團，由出團時間近到遠排序  -- (筆數)
	select COUNT(*)
		from tour_participate tp
			join tour T on(tp.tour_participate_tour = T.tour_no)
			join mountain M on(T.tour_mountain = M.mountain_no)
		WHERE tp.tour_participate_mem = 10009 -- 之後改變數
		and T.tour_progress = '已結束' 
		and M.mountain_area = 'south'
		order BY T.tour_activitystart DESC;

----------------------------------------------------------------------------------------------------------

-- 會員已獲得的徽章，由獲得時間近到遠排序
select ma.achievement_no, ma.achievement_date, M.mem_no, M.mem_name, A.achievement_name, A.achievement_image, A.achievement_category
		from mem_achievement ma
			join member M on(ma.mem_no = M.mem_no)
			join achievement A on(ma.achievement_no = A.achievement_no)
		WHERE ma.mem_no = 10001  -- 之後改變數
		order by ma.achievement_date desc;

----------------------------------------------------------------------------------------------------------
-- 會員收藏討論文章，由新到舊排序
select fk.forum_keep_mem'誰收藏', fk.forum_iskept_post'收藏哪篇' ,fp.forum_post_no'討論文章編號' ,fp.forum_post_category'討論文章類別' ,fp.forum_post_title'討論文標題' ,fp.forum_post_image'討論文圖片' ,fp.forum_post_innertext'討論文內文' ,fp.forum_post_time'發文時間' 
	from forum_keep fk 
    	join forum_post fp on(fk.forum_iskept_post = fp.forum_post_no)
    WHERE fk.forum_keep_mem = 10008  -- 之後改變數
    order BY fp.forum_post_time DESC;


-- 會員收藏揪團行程，由新到舊排序
select tk.tour_keep_mem'誰收藏', tk.tour_iskept_tour'收藏哪團', T.tour_no'揪團編號', T.tour_title'揪團文標題', T.tour_innertext'活動簡介', T.tour_build'建立時間', M.mountain_image'山的圖片'
	from tour_keep tk
		join tour T on(tk.tour_iskept_tour = T.tour_no)
		join mountain M on(T.tour_mountain = M.mountain_no)
	WHERE tk.tour_keep_mem = 10008  -- 之後改變數
    order BY T.tour_build DESC;

-- 會員收藏商品品項，由編號小到大排序
select pk.product_keep_mem'誰收藏', pk.product_iskept_no'收藏哪項', P.product_no'商品編號', P.product_image1'商品圖1', P.product_name'商品名稱', P.product_description'商品說明'
	from product_keep pk
		join product P on(pk.product_iskept_no = P.product_no)
    WHERE pk.product_keep_mem = 10008  -- 之後改變數and
    order BY P.product_no DESC; -- 因為沒有建立日期所以用編號排序

----------------------------------------------------------------------------------------------------------

-- 會員發起的揪團，由出團時間近到遠排序
select T.tour_hoster'揪團主', T.tour_no'揪團編號', T.tour_title'揪團文標題',T.tour_innertext'活動簡介', T.tour_apply'已報名人數', T.tour_activitystart'活動開始日期', M.mountain_image'山的圖片', M.mountain_area'山的地區', M.degree_category'山的難度', M.mountain_name
	from tour T
		join mountain M on(T.tour_mountain = M.mountain_no)
	WHERE T.tour_hoster = 10009  -- 之後改變數
    order BY T.tour_activitystart DESC;

-- 會員參加的揪團，由出團時間近到遠排序
select tp.tour_participate_mem'誰參加', tp.tour_participate_tour'參加哪團', tp.tour_participate_situation'審核狀態', T.tour_no'揪團編號', T.tour_title'揪團文標題',T.tour_innertext'活動簡介', T.tour_apply'已報名人數', T.tour_activitystart'活動開始日期', M.mountain_image'山的圖片', M.mountain_area'山的地區', M.degree_category'山的難度', M.mountain_name'山的名字'
	from tour_participate tp
		join tour T on(tp.tour_participate_tour = T.tour_no)
        join mountain M on(T.tour_mountain = M.mountain_no)
	WHERE tp.tour_participate_mem = 10009  -- 之後改變數
	order BY T.tour_activitystart DESC;

----------------------------------------------------------------------------------------------------------

-- 會員發佈的文章，由發布時間新到舊排序
select fk.forum_keep_mem, fk.forum_iskept_post, fp.forum_post_no, fp.forum_post_title, fp.forum_post_image, fp.forum_post_innertext, fp.forum_post_time, fp.forum_post_category, c.comment_poster, min(c.comment_time) Min, m.mem_id
                from forum_keep fk 
                    join forum_post fp on(fk.forum_iskept_post = fp.forum_post_no)
                    join comment_post c on(fp.forum_post_no = c.forum_post_no and c.comment_situation = 1)
                    join member m on(c.comment_poster = m.mem_no)
                WHERE fk.forum_keep_mem = 10008  -- 之後改變數
                order BY fp.forum_post_time DESC;