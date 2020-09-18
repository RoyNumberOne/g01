new Vue({
    el: "#comment",
    data: {
        dialog:[],
        reflection:[],
        commentpost:[],
        poster_message: '',
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
        axios.post('./phpForConnect/commentPostReflection.php',formArticle).then(res => {
            this.reflection = res.data;
            console.log('success');
            console.log(this.reflection);
        }),
        //從comment篩選討論區的class
        axios.post('./phpForConnect/forumCommentPost.php', formArticle).then(res => {
            this.commentpost = res.data;
            console.log('success');
            console.log(this.commentpost);
        }),
        // 留言回覆區
        axios.post('./phpForConnect/commentPostDialog.php',formArticle).then(res => {
            console.log(res.data.length);
            for (var i = 0;i<res.data.length;i++){
                this.dialog.push(res.data[i]);
            };
            console.log('success');
            console.log(this.dialog);
        })
    },
    methods :{
        clearTextarea(){
            this.poster_message = '';
        },
        SENDmsg: function(){
            if($('#mem_info_id').html() === ''){
                alert ('請先登入');
                window.location.href = './login_v2.html';
            };
            var temp = $('#message_area').val();
            // console.log(temp);
            if(temp == ''){
                alert('請先輸入文字');
            }else{
                let poster_messageData = new FormData;
                let formArticle = new FormData();

                let urlSearchParams = (new URL(document.location)).searchParams;
                forum_post_no = urlSearchParams.get('forum_post_no');

                formArticle.append("forum_post_no", forum_post_no);  

                axios.get('./phpForConnect/forum-comment_MessageArea.php', {params:{
                    "comment_class" : '討論區',
                    "forum_post_no" : forum_post_no,
                    "comment_innertext" : this.poster_message,
                }}).then(res => {
                    console.log('success poster_message');
                    axios.post('./phpForConnect/commentPostDialog.php', formArticle).then(res => {
                    this.dialog = res.data;
                    // this.clearTextarea();
                    $('html, body').animate({ scrollTop: 100000 }, 500);
                    })
                });
            }
        }
    }
})

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