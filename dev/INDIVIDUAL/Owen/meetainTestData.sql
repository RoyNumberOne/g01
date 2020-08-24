SET SQL_SAFE_UPDATES=0;
-- use Meetain;
use meetainDataIn;
-- use meetainTest;


SELECT * FROM achievement;
desc achievement;

SELECT * FROM member;
desc member;

SELECT * FROM administrator;
desc administrator;

SELECT * FROM comment_post;
desc comment_post;

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

SELECT * FROM forum_post;
desc forum_post;

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
SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由", forum_report_banLong "檢舉時長", ban_forum_date "解封時間" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no join member mem on forum_report_mem = mem.mem_no where fr.forum_report_situation = "已處理已通過" ;
-- 討論檢舉 - 已處理未通過 - 後台
SELECT forum_report_no "檢舉編號" , forum_report_post "討論編號" , forum_post_title "討論標題" , forum_post_poster "被檢舉人" , forum_report_build "檢舉時間", forum_report_reason "檢舉緣由",forum_report_situation "檢舉狀態" from forum_report fr join forum_post fp on fr.forum_report_post = fp.forum_post_no where fr.forum_report_situation = "已處理未通過" ;

SELECT * FROM mem_achievement;
desc mem_achievement;

SELECT * FROM member;
desc member;

SELECT * FROM member_guide;
desc member_guide;
-- 嚮導認證 - 未處理
SELECT * FROM member_guide where mem_guide_situation = "未審核";
-- 嚮導認證 - 未處理的數量
SELECT count(*) FROM member_guide where mem_guide_situation = "未審核";

-- insert into member_guide (guide_no,mem_no,guide_period_start,guide_period_end,guide_image) value ('101061','10002','1998/5/6', date_add('1998/5/6', interval 4 year),'#');

SELECT * FROM member_keep;
desc member_keep;

SELECT * FROM member_realname;
desc member_realname;
-- 實名制認證 - 未處理
SELECT * FROM member_realname where mem_realname_situation = "未審核";
-- 實名制認證 - 未處理的數量
SELECT count(*) FROM member_realname where mem_realname_situation = "未審核";

SELECT * FROM mountain;
desc mountain;

SELECT * FROM order_list;
desc order_list;

SELECT * FROM orders;
desc orders;

SELECT * FROM product;
desc product;

SELECT * FROM product_keep;
desc product_keep;

SELECT * FROM tour;
desc tour;

SELECT * FROM tour_keep;
desc tour_keep;

SELECT * FROM tour_participate;
desc tour_participate;

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
SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由", tour_report_banLong "檢舉時長", ban_tour_date "解封時間" from tour_report tr join tour t on tr.tour_report_tour = t.tour_no join member mem on tour_report_mem = mem.mem_no where tr.tour_report_situation = "已處理已通過" ;
-- 揪團檢舉 - 已處理未通過 - 後台
SELECT tour_report_no "檢舉編號" , tour_report_tour "揪團編號" , tour_title "揪團標題" , tour_hoster "被檢舉人" , tour_report_build "檢舉時間", tour_report_reason "檢舉緣由",tour_report_situation "檢舉狀態" from tour_report tr join tour t on tr.tour_no = fp.forum_post_no where fr.forum_report_situation = "已處理未通過" ;

-- select * from tour t join mountain m on t.tour_mountain = m.mountain_no where m.degree_category = 4 and m.mountain_area = 'east';
-- select * from tour t join mountain m on t.tour_mountain = m.mountain_no where m.degree_category = 4 and m.mountain_area = 'west';