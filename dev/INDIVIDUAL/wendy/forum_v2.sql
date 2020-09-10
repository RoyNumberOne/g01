
-- 討論區文章留言 舊到新--
select cp.forum_post_no, cp.comment_poster, cp.comment_innertext, m.mem_no, m.mem_id, m.mem_avator, m.mem_badge1, m.mem_badge2, m.mem_badge3, mr.mem_realname_situation, mg.mem_guide_situation
	FROM comment_post cp
		join member m on(m.mem_no = cp.comment_poster)
        join forum_post fp on (fp.forum_post_no = cp.forum_post_no)
        left join member_realname mr on(mr.mem_no = m.mem_no and mr.mem_realname_situation = '已審核已通過')
        left join member_guide mg on(mg.mem_no = m.mem_no and mg.mem_guide_situation = '已審核已通過')
	where fp.forum_post_no = 200009 -- 要再換變數
    group by m.mem_no
    order by cp.comment_time;