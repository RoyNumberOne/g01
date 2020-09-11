-- 會員收藏文章，由新到舊排序
select fk.forum_keep_mem,fk.forum_iskept_post,fp.forum_post_no,fp.forum_post_title,fp.forum_post_image,fp.forum_post_innertext,fp.forum_post_time
	from forum_keep fk 
    	join forum_post fp on(fk.forum_iskept_post = fp.forum_post_no)
    WHERE fk.forum_keep_mem = 10008
    order BY fp.forum_post_time DESC;