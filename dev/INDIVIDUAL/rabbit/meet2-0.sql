-- 揪團區首頁 地圖 -- secretMessages 的 Ａ
SELECT    t.tour_mountain "山的編號", mt.mountain_name "山的名字" , t.tour_build "建立時間" ,m.mem_id "會員暱稱",t.tour_title"揪團文標題"
FROM tour t
		JOIN member m ON t.tour_hoster = m.mem_no
        JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
WHERE t.tour_situation = 1 and tour_progress = '報名中' and t.tour_mountain = :tour_mountain
ORDER BY t.tour_build DESC ;


-- 揪團區首頁貼文  -- 熱門
SELECT  t.tour_no , t.tour_hoster, m.mem_id ,r.mem_realname , g.guide_no , m.mem_avator, m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , mt.mountain_area ,mt.degree_category, t.tour_mountain , mt.mountain_name , mt.mountain_image , t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*),t.tour_min_number,t.tour_max_number, DATEDIFF(t.tour_activityend ,t.tour_activitystart)+1 days
    FROM tour t
            LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
            LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON t.tour_hoster = m.mem_no
            JOIN comment_post c ON t.tour_no = c.tour_post_no
            JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
    WHERE t.tour_situation = 1 and tour_progress = '報名中'
    GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no
    ORDER BY COUNT(*) DESC , t.tour_build DESC
    LIMIT 3;


-- 揪團區首頁貼文 -- 最新

SELECT  t.tour_no , t.tour_hoster, m.mem_avator,m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , mt.mountain_area ,mt.degree_category, t.tour_mountain , mt.mountain_name,mt.mountain_image ,  t.tour_activitystart , t.tour_activityend , t.tour_build ,t.tour_title , t.tour_notice , t.tour_innertext , COUNT(*) ,t.tour_min_number,t.tour_max_number, DATEDIFF(t.tour_activityend ,t.tour_activitystart)+1 days
    FROM tour t
            LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
            LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON t.tour_hoster = m.mem_no
            LEFT OUTER JOIN comment_post c ON t.tour_no = c.tour_post_no
            JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
    WHERE t.tour_situation = 1 and tour_progress = '報名中'
    GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no , c.tour_post_no
    ORDER BY t.tour_build DESC , t.tour_no DESC;

-- 揪團詳細頁 --
SELECT t.tour_no, t.`tour_hoster`, t.`tour_mountain`, t.`tour_build`, t.`tour_end`, t.`tour_activitystart`, t.`tour_activityend`, t.`tour_min_number`, t.`tour_max_number`, t.`tour_progress`,t.`tour_apply`, t.`tour_passed`, t.`tour_verify`, t.`tour_reject`, t.`tour_title`, t.`tour_notice`, t.`tour_innertext`, t.`tour_situation`, t.`tour_equip_1`, t.`tour_equip_2`, t.`tour_equip_3`, t.`tour_equip_4`, t.`tour_equip_5`, t.`tour_image_1`, t.`tour_image_2`, t.`tour_image_3`, t.`tour_image_4`, t.`tour_image_5`, t.`tour_image_6`, m.mem_avator,m.mem_id ,r.mem_realname , g.guide_no , m.mem_badge1 , m.mem_badge2 , m.mem_badge3 , mt.mountain_area ,mt.degree_category,  mt.mountain_name,mt.mountain_image , COUNT(*) 
    FROM tour t
            LEFT OUTER JOIN member_realname r ON ( t.tour_hoster = r.mem_no and r.mem_realname_situation = '已審核已通過')
            LEFT OUTER JOIN member_guide g ON ( t.tour_hoster = g.mem_no and g.mem_guide_situation = '已審核已通過')
            JOIN member m ON t.tour_hoster = m.mem_no
            LEFT OUTER JOIN comment_post c ON t.tour_no = c.tour_post_no
            JOIN MOUNTAIN mt on t.tour_mountain = mt.mountain_no
    WHERE t.tour_situation = 1 and tour_progress = '報名中' and t.tour_no = 100016
    GROUP BY t.tour_hoster,t.tour_no,r.mem_realname , g.guide_no , mt.mountain_no , c.tour_post_no;
    