new Vue({
    el: "#comment",
    data: {
        issuanarea:[],
        messagearea:[],
    },
    created(){
    },
    mounted() {
        let formArticle = new FormData();
        let urlSearchParams = (new URL(document.location)).searchParams;
        forum_post_no = urlSearchParams.get('forum_post_no');
        console.log(forum_post_no)
        formArticle.append("forum_post_no", forum_post_no);  
        
        //文章發布
        axios.post('./phpForConnect/announcement_IssuanArea.php',formArticle).then(res => {
            this.issuanarea = res.data;
            console.log('success');
            console.log(this.issuanarea);
        })
        // 留言回覆區
        axios.post('./phpForConnect/announcement_MessageArea.php',formArticle).then(res => {
            console.log(res.data.length);
            for (var i = 0;i<res.data.length;i++){
                this.messagearea.push(res.data[i]);
            };
            console.log('success');
            console.log(this.messagearea);
        })
    },
});

//.heart chage img src
$(document).ready(function(){
    $(".commentCollect").click(function(){
        if($(".heart").attr('src') === "./images/icons/icon_heart.svg"){
            $(".heart").attr("src","./images/icons/icon_heart_h&c.svg");
        }else{
            $(".heart").attr("src","./images/icons/icon_heart.svg");
        }
    });

    //show .add_count
    $(".add_chart").click(function(){
        $(".add_count").css("display", "block");
    }); 

    //dot .pic change bgcolor
    $(".pic").click(function(){
        $(this).addClass("pick");
        $(this).siblings().removeClass("pick");
    });

    //reset dot .pic bgcolor
    $(".reset_dot").click(function(){
        $(".pic").removeClass("pick");
    });

    //pick size
    $(".size").click(function() {
        $(this).addClass("picked_size");
        $(this).siblings().removeClass("picked_size");
    });
});