SET SQL_SAFE_UPDATES=0;
-- use Meetain;
use meetainDataIn;
-- use meetainTest;


SELECT * FROM achievement;
desc achievement;

SELECT * FROM member;
desc member;

select m.* , guide_no from `member` m left outer join `member_guide` mg on (m.mem_no = mg.mem_no and mem_guide_situation = '已審核已通過') ;
UPDATE comment_post set comment_situation = 0 where comment_no=300002;
-- 使用中徽章
SELECT  m.mem_no ,m.mem_badge1 , a1.achievement_image , a1.achievement_category ,a1.achievement_name , m.mem_badge2 , a2.achievement_image , a2.achievement_category ,a2.achievement_name , m.mem_badge3 , a3.achievement_image  , a3.achievement_category ,a3.achievement_name
FROM member m
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
WHERE m.mem_no = 10001 ;

update member set mem_badge1 = 10 where mem_no = 10001;


-- 討論區發文
select * from forum_post;
select forum_post_no , forum_post_title '發表文章' , forum_post_time '建立時間' , 8000 '點數' 
from forum_post
where forum_post_poster = 10010 order by forum_post_no desc LIMIT 3;
-- 揪團區開團 
select t.tour_no , t.tour_title '發起揪團', tp.tour_participate_time '建立時間'  , 6000 '點數' 
from tour_participate tp  join tour t on (tp.tour_participate_tour = t.tour_no and t.tour_hoster= 10010 )
WHERE tp.tour_participate_mem = 10010 order by tour_no desc LIMIT 3;
-- 揪團區參團 
SELECT t.tour_no , t.tour_title '參加揪團' , tp.tour_participate_time '建立時間' , 3000 '點數'
from tour_participate tp  join tour t on (tp.tour_participate_tour = t.tour_no and not t.tour_hoster= 10010 )
WHERE tp.tour_participate_mem = 10010 order by tour_no desc LIMIT 3;

select * from mem_achievement ;
desc mem_achievement;
INSERT INTO mem_achievement (mem_no , achievement_no) values ( 10008 , 2);

-- 判斷徽章
SELECT m.mem_no , m.total_post , m.total_host , m.total_join , DATEDIFF(CURDATE(),`mem_build`) 'datediff' from member m where m.mem_no = 10008;
-- 判斷徽章
SELECT a.achievement_no , a.achievement_require, ma.mem_no 
	from achievement a
	left outer join mem_achievement ma on ( a.achievement_no = ma.achievement_no and ma.mem_no = 10008)
	group by a.achievement_no , ma.achievement_no;


SELECT * FROM administrator;
desc administrator;
-- 顯示所有管理員
select admin_no , admin_name , admin_id , admin_mail , admin_build from administrator ;
-- 顯示未停權管理員
select admin_no '管理員編號'  , admin_name '姓名' , admin_id '暱稱' , admin_mail '電子信箱' , admin_build '建立時間' from  administrator where admin_authority > 0;
-- 顯示所有管理員連動前台會員帳密資訊
select admin_no , admin_name , admin_id , admin_mail , admin_build , mem_avator from administrator join member on admin_acc = member.mem_acc;

SELECT * FROM comment_post;
select * from comment_post where comment_class = "揪團區" ;
select tour_post_no , count(*) from comment_post where comment_class = "揪團區" group by tour_post_no ;
desc comment_post;

SELECT c.tour_post_no, COUNT(1) AS "number_of_appointments"
FROM comment_post c
  LEFT JOIN tour t ON t.tour_no = c.tour_post_no
GROUP BY c.tour_post_no;

SELECT * FROM comment_report;
desc comment_report;
-- 被檢舉的所有留言 - 未處理
select * from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "未處理";
-- 被檢舉的所有留言 - 未處理的數量
select count(*) from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "未處理";
-- 留言檢舉 - 未處理 - 後台
SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "未處理" ;
-- 留言檢舉 - 已處理已通過 - 後台
SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_banLong "檢舉時長", ban_forum_date "討論區解封時間", ban_tour_date "揪團解封時間" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no join member mem on comment_report_mem = mem.mem_no where cr.comment_report_situation = "已處理已通過" ;
-- 留言檢舉 - 已處理未通過 - 後台
SELECT comment_report_no "檢舉編號" , comment_report_comment "留言編號" , comment_innertext "留言內文" , comment_poster "被檢舉人" , comment_report_build "檢舉時間", comment_report_reason "檢舉緣由" , comment_class "檢舉板塊" , comment_report_situation "檢舉狀態" from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cr.comment_report_situation = "已處理未通過" ;
-- 被檢舉的討論區留言
select * from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cp.comment_class="討論區";
-- 被檢舉的討論區留言 - 未處理
select * from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cp.comment_class="討論區" and cr.comment_report_situation = "未處理" ;
-- 被檢舉的討論區留言 - 未處理的數量
select count(*) from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cp.comment_class="討論區" and cr.comment_report_situation = "未處理" ;
-- 被檢舉的揪團留言
select * from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cp.comment_class="揪團";
-- 被檢舉的揪團留言 - 未處理
select * from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cp.comment_class="揪團" and cr.comment_report_situation = "未處理" ;
-- 被檢舉的揪團留言 - 未處理的數量
select count(*) from comment_report cr join comment_post cp on cr.comment_report_comment = cp.comment_no where cp.comment_class="揪團" and cr.comment_report_situation = "未處理" ;

SELECT * FROM degree;
desc degree;

SELECT * FROM forum_keep;
desc forum_keep;
-- 個人追蹤的文章
select fk.forum_keep_mem '會員編號', fk.forum_iskept_post '文章編號' , fp.forum_post_category '文章類別', fp.forum_post_title '文章標題' , forum_post_innertext '文章內文' from forum_keep fk 
	join member m on fk.forum_keep_mem = m.mem_no
    join forum_post fp on fk.forum_iskept_post = fp.forum_post_no
    where fk.forum_keep_mem = 10012;

SELECT * FROM forum_post;
desc forum_post;
-- 熱門討論文
select f.forum_post_no '討論文編號' , count(*) '留言數量' from forum_post f join comment_post c on f.forum_post_no = c.forum_post_no where c.comment_class="討論區" group by f.forum_post_no order by count(*) desc,f.forum_post_no desc; 
-- 最新討論文
select forum_post_no '討論文編號' , forum_post_time '發文時間' from forum_post order by forum_post_no desc; 
-- 討論區首頁貼文 -- 非公告 -- 熱門
SELECT  f.forum_post_no , f.forum_post_poster, m.mem_id ,r.mem_realname , g.guide_no ,m.mem_badge1 , a1.achievement_image , m.mem_badge2 , a2.achievement_image , m.mem_badge3 , a3.achievement_image , f.forum_post_image , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT( distinct c.comment_innertext) , max(c.comment_time) , COUNT( distinct fk.forum_keep_mem) 
FROM forum_post f
		LEFT OUTER JOIN member_realname r ON ( f.forum_post_poster = r.mem_no and r.mem_realname_situation = '已審核已通過')
		LEFT OUTER JOIN member_guide g ON ( f.forum_post_poster = g.mem_no and g.mem_guide_situation = '已審核已通過')
        JOIN member m ON f.forum_post_poster = m.mem_no
        JOIN comment_post c ON (f.forum_post_no = c.forum_post_no  and c.comment_situation = 1 and c.forum_post_no=f.forum_post_no)
        LEFT OUTER JOIN forum_keep fk on fk .forum_iskept_post = f.forum_post_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
WHERE f.forum_post_situation = 1 and forum_post_category not in ('公告')
GROUP BY f.forum_post_poster,c.forum_post_no,r.mem_realname , g.guide_no 
ORDER BY COUNT(*) DESC , f.forum_post_no DESC;
-- 討論區首頁貼文 -- 非公告 -- 最新
SELECT  f.forum_post_no , f.forum_post_poster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , a1.achievement_image , m.mem_badge2 , a2.achievement_image , m.mem_badge3 , a3.achievement_image, f.forum_post_image , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT( distinct c.comment_innertext) , max(c.comment_time) , COUNT( distinct fk.forum_keep_mem) 
FROM forum_post f
		LEFT OUTER JOIN member_realname r ON ( f.forum_post_poster = r.mem_no and r.mem_realname_situation = '已審核已通過')
		LEFT OUTER JOIN member_guide g ON ( f.forum_post_poster = g.mem_no and g.mem_guide_situation = '已審核已通過')
        JOIN member m ON f.forum_post_poster = m.mem_no
        JOIN comment_post c ON (f.forum_post_no = c.forum_post_no  and c.comment_situation = 1 and c.forum_post_no=f.forum_post_no)
        LEFT OUTER JOIN forum_keep fk on fk .forum_iskept_post = f.forum_post_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
WHERE f.forum_post_situation = 1 and forum_post_category not in ('公告')
GROUP BY f.forum_post_poster,c.forum_post_no,r.mem_realname , g.guide_no 
ORDER BY f.forum_post_time DESC , f.forum_post_no DESC;
-- 某會員曾發過的貼文 -- 非公告
SELECT  f.forum_post_no , f.forum_post_poster, m.mem_id , f.forum_post_image , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT( distinct c.comment_innertext) , max(c.comment_time) , COUNT( distinct fk.forum_keep_mem) 
FROM forum_post f
        JOIN member m ON f.forum_post_poster = m.mem_no
        JOIN comment_post c ON (f.forum_post_no = c.forum_post_no  and c.comment_situation = 1 and c.forum_post_no=f.forum_post_no)
        LEFT OUTER JOIN forum_keep fk on fk .forum_iskept_post = f.forum_post_no
WHERE f.forum_post_situation = 1 and forum_post_category not in ('公告') and forum_post_poster = 10009
GROUP BY f.forum_post_poster,c.forum_post_no
ORDER BY f.forum_post_time DESC , f.forum_post_no DESC;

-- 討論區首頁貼文 -- 公告 -- 最新3篇
SELECT  f.forum_post_no , f.forum_post_poster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , a1.achievement_image , m.mem_badge2 , a2.achievement_image , m.mem_badge3 , a3.achievement_image , f.forum_post_category , f.forum_post_time , f.forum_post_title , f.forum_post_innertext , COUNT(*) 
FROM forum_post f
		LEFT OUTER JOIN member_realname r ON ( f.forum_post_poster = r.mem_no and r.mem_realname_situation = '已審核已通過')
		LEFT OUTER JOIN member_guide g ON ( f.forum_post_poster = g.mem_no and g.mem_guide_situation = '已審核已通過')
        JOIN member m ON f.forum_post_poster = m.mem_no
        JOIN comment_post c ON f.forum_post_no = c.forum_post_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
WHERE f.forum_post_situation = 1 and forum_post_category = '公告'
GROUP BY f.forum_post_poster,c.forum_post_no,r.mem_realname , g.guide_no
ORDER BY f.forum_post_time DESC , f.forum_post_no DESC limit 3;

SELECT * FROM forum_report;
desc forum_report;
-- 被檢舉的討論文
select * from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no ;
-- 被檢舉的討論文 - 未處理
select * from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "未處理" ;
-- 被檢舉的討論文 - 未處理的數量
select count(*) from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "未處理" ;
-- 討論檢舉 - 未處理 - 後台
SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "未處理" ;
-- 討論檢舉 - 已處理已通過 - 後台
SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由", forum_report_banLong "檢舉時長", ban_forum_date "解封時間" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no join member mem on forum_post_poster = mem.mem_no where fr.forum_report_situation = "已處理已通過" ;
-- 討論檢舉 - 已處理未通過 - 後台
SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由",forum_report_situation "檢舉狀態" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "已處理未通過" ;

SELECT * FROM mem_achievement;
desc mem_achievement;

SELECT * FROM member;
desc member;

SELECT * FROM member_guide;
desc member_guide;
-- 嚮導認證 - 未處理的數量
SELECT count(*) FROM member_guide where mem_guide_situation = "未審核";
-- 嚮導認證 - 未處理
SELECT * FROM member_guide where mem_guide_situation = "未審核";
SELECT member_guide_no "no" , mem_no "會員編號" , guide_image "證件照片" , guide_no "嚮導證編號" , guide_period_start "發證日期" , guide_period_end "有效日期" , mem_guide_apply "申請時間"  FROM member_guide where mem_guide_situation = "未審核" order by mem_guide_apply ;
-- 嚮導認證 - 已處理已通過
SELECT member_guide_no "no" , mem_no "會員編號" , guide_image "證件照片" , guide_no "嚮導證編號" , guide_period_start "發證日期" , guide_period_end "有效日期" , mem_guide_apply "申請時間" , mem_guide_verify "審核時間"  FROM member_guide where mem_guide_situation = "已審核已通過" order by mem_guide_verify desc ;
-- 嚮導認證 - 已處理未通過
SELECT member_guide_no "no" , mem_no "會員編號" , guide_image "證件照片" , guide_no "嚮導證編號" , guide_period_start "發證日期" , guide_period_end "有效日期" , mem_guide_apply "申請時間" , mem_guide_verify "審核時間"  FROM member_guide where mem_guide_situation = "已審核未通過" order by mem_guide_verify desc ;
-- 嚮導認證 - 送出已審核已通過
update member_guide set mem_guide_verify = current_timestamp , mem_realname_situation = '已審核已通過' where member_realname_no = 5001;
-- 嚮導認證 - 送出已審核未通過
update member_guide set mem_guide_verify = current_timestamp , mem_realname_situation = '已審核未通過' where member_realname_no = 5001;

-- insert into member_guide (guide_no,mem_no,guide_period_start,guide_period_end,guide_image) value ('101061','10002','1998/5/6', date_add('1998/5/6', interval 4 year),'#');

SELECT * FROM member_keep;
desc member_keep;

SELECT * FROM member_realname;
desc member_realname;
-- 實名制認證 - 未審核的數量
SELECT count(*) FROM member_realname where mem_realname_situation = "未審核";
-- 實名制認證 - 未處理
SELECT member_realname_no "no" , mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間"  FROM member_realname where mem_realname_situation = "未審核" order by "申請時間" ;
-- 實名制認證 - 已審核已通過
SELECT member_realname_no "no" ,  mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間" , mem_realname_verify "審核時間"  FROM member_realname where mem_realname_situation = "已審核已通過" order by mem_realname_verify desc  ;
-- 實名制認證 - 已審核未通過
SELECT member_realname_no "no" ,  mem_no "會員編號" , mem_idno_image "證件照片" , mem_idno "身分證字號" , mem_realname "真實姓名" , mem_realname_apply "申請時間" , mem_realname_verify "審核時間"  FROM member_realname where mem_realname_situation = "已審核未通過" order by mem_realname_verify desc ;
-- 實名制認證 - 送出已審核已通過
update member_realname set mem_realname_verify = current_timestamp , mem_realname_situation = '已審核已通過' where member_realname_no = 4001;
-- 實名制認證 - 送出已審核未通過
update member_realname set mem_realname_verify = current_timestamp , mem_realname_situation = '已審核未通過' where member_realname_no = 4001;

SELECT * FROM mountain;
desc mountain;

SELECT * FROM orders;
desc orders;
-- 訂單總覽 - 後台
select order_no '訂單編號' , member_no '會員編號' , order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_cashflow '付款方式' , order_position '訂單狀態' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders order by order_no limit 6;
-- 找訂單編號
select order_no from orders where member_no = 10011 order by order_no desc limit 1;


SELECT * FROM order_list;
desc order_list;
-- 訂單詳細 - 後台
select order_no '訂單編號' , member_no '會員編號' , order_logistics_recipient'收件人' , order_logistics_phone '聯絡電話' , order_logistics_deliver '運送方式' , order_cashflow '付款方式' , order_position '訂單狀態' , order_logistics_address '收件地址' , order_total '原始金額' , order_discount '折扣' , order_logistics_fee '運費' , round( order_total * ( 100 - order_discount ) / 100 + order_logistics_fee ) '付款金額' , order_build '訂單成立時間' from orders where order_no = 500001;
select product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價' from order_list join product on order_list.product_no = product.product_no ; -- where order_no = 500001;
select * from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no where order_list.order_no = 500001;
select product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價'  from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no where orders.member_no = 10011;

SELECT * FROM product;
desc product;
-- 商品 - 上架中
select product_no "商品編號" , degree_category "商品難度等級" , product_category "商品分類" , product_name "商品名稱" , product_price "商品價格" , product_description "商品說明" , product_image1 "商品圖片一" , product_image2 "商品圖片二" , product_image3 "商品圖片三" from product where product_situation = 1; 
-- 商品 - 未上架
select product_no "商品編號" , degree_category "商品難度等級" , product_category "商品分類" , product_name "商品名稱" , product_price "商品價格" , product_description "商品說明" , product_image1 "商品圖片一" , product_image2 "商品圖片二" , product_image3 "商品圖片三" from product where product_situation = 0; 
-- 商品 - 新增
-- INSERT INTO product (product_name,product_category,degree_category,product_price,product_description,product_image1,product_image2,product_image3,product_situation)
--     VALUES ('測試啦反正不會成功1', '登山鞋','2','100','跳樓大拍賣100元','default','default','default','0');
-- 商品 - 熱門
select p.product_no , p.product_name , count(*) , p.product_price , p.product_description , p.product_image1 from product p join order_list o on p.product_no = o.product_no where product_situation = 1 group by o.product_no order by count(*) desc ;


SELECT * FROM product_keep;
desc product_keep;

SELECT * FROM tour;
desc tour;

update tour set tour_image_1 = concat('./images/tour_image/',`tour_no`,'_1.jpg') where tour_no in (100001);
-- 揪團區首頁貼文  -- 熱門
SELECT  t.tour_no , t.tour_hoster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , a1.achievement_image , m.mem_badge2 , a2.achievement_image , m.mem_badge3 , a3.achievement_image , mt.mountain_area , t.tour_mountain , mt.mountain_name , mt.mountain_image , mt.degree_category , t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*) 
FROM tour t
		LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
		LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
        JOIN member m ON t.tour_hoster = m.mem_no
        LEFT OUTER JOIN comment_post c ON t.tour_no = c.tour_post_no
        JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
WHERE t.tour_situation = 1 and tour_progress = '報名中'
GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no , c.tour_post_no
ORDER BY COUNT(*) DESC , t.tour_build DESC;
-- 揪團區首頁貼文 -- 最新
SELECT  t.tour_no , t.tour_hoster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , a1.achievement_image , m.mem_badge2 , a2.achievement_image , m.mem_badge3 , a3.achievement_image , mt.mountain_area , t.tour_mountain , mt.mountain_name , mt.mountain_image , mt.degree_category ,  t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*) 
FROM tour t
		LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
		LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
        JOIN member m ON t.tour_hoster = m.mem_no
        LEFt OUTER JOIN comment_post c ON t.tour_no = c.tour_post_no
        JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
        LEFT OUTER JOIN achievement a1 on m.mem_badge1 = a1.achievement_no
        LEFT OUTER JOIN achievement a2 on m.mem_badge2 = a2.achievement_no
        LEFT OUTER JOIN achievement a3 on m.mem_badge3 = a3.achievement_no
WHERE t.tour_situation = 1 and tour_progress = '報名中'
GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no , c.tour_post_no
ORDER BY t.tour_build DESC , t.tour_no DESC;

select * from member;
select * from member_realname;
SELECT m.mem_no ,r.mem_realname FROM member m left outer JOIN member_realname r ON (m.mem_no = r.mem_no );

select tour_no '討論文編號' , tour_build '發文時間' from tour order by tour_no desc; 

SELECT product.product_image1 '商品預覽' , order_list.product_no '商品編號' , product.product_name '商品名稱' , product.degree_category '難度等級' , order_list.product_number'購買數量' , order_list.product_price '商品單價'  from order_list join product on order_list.product_no = product.product_no join orders on order_list.order_no = orders.order_no join member on orders.member_no = member.mem_no where orders.order_no = 500002;
SELECT * FROM tour_keep;
desc tour_keep;

SELECT * FROM tour_participate;
desc tour_participate;

select tour_participate_mem , tour_participate_situation
from tour_participate
where tour_participate_tour = 100001 and tour_participate_mem = 10012;

SELECT * FROM tour_report;
desc tour_report;
-- 被檢舉的揪團
select * from tour_report tr join tour t on tr.tour_report_tour = t.tour_no;
-- 被檢舉的揪團 - 未處理
select * from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理" ;
-- 被檢舉的揪團 - 未處理的數量
select count(*) from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理" ;
-- 揪團檢舉 - 未處理 - 後台
SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no where tr.tour_report_situation = "未處理" ;
-- 揪團檢舉 - 已處理已通過 - 後台
SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由", tour_report_banLong "檢舉時長", mem.ban_tour_date "解封時間" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no join member mem on tour_hoster = mem.mem_no where tr.tour_report_situation = "已處理已通過" ;

update tour_report set  tour_report_situation = '已處理已通過' , tour_report_banLong = '5 minute' where tour_report_no = '1003';

update member set  ban_tour = 1 ,ban_tour_date = date_add(current_timestamp, interval 5 minute) where mem_no = 10012;
update member set  ban_tour = 0 , ban_tour_date = null where mem_no = 10013;
-- 揪團檢舉 - 已處理未通過 - 後台
SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由",tour_report_situation "檢舉狀態" from tour_report tr join tour t on tr.tour_no = fp.forum_post_no where fr.forum_report_situation = "已處理未通過" ;

-- select * from tour t join mountain m on t.tour_mountain = m.mountain_no where m.degree_category = 4 and m.mountain_area = 'east';
-- select * from tour t join mountain m on t.tour_mountain = m.mountain_no where m.degree_category = 4 and m.mountain_area = 'west';