new Vue({
    el: "#comment",
    data: {
        issuanarea:[],
        messagearea:[],
        commentpost:[],
        // ann_CommentPost:[],
        poster_message: '',
        message_report_img: [],
        currentPage: 1,

    },
    created(){
        //抓是否檢舉過某則留言，後面會用此判斷是否換該留言檢舉圖示
        // formMessageReport = new FormData();
        urlSearchParams = (new URL(document.location)).searchParams;
        forum_post_no = urlSearchParams.get('forum_post_no');
        // formMessageReport.append("forum_post_no", forum_post_no);
        axios.get('./phpForConnect/forum_comment_report_img.php', {
            params: {
                "forum_post_no": forum_post_no,
            }
        }).then(res => {
            this.message_report_img = res.data;
        })
    },
    mounted() {
        let formArticle = new FormData();
        let urlSearchParams = (new URL(document.location)).searchParams;
        forum_post_no = urlSearchParams.get('forum_post_no');
        formArticle.append("forum_post_no", forum_post_no);
        
        //文章發布
        axios.post('./phpForConnect/announcement_IssuanArea.php',formArticle).then(res => {
            this.issuanarea = res.data;
        }),
        //從comment篩選討論區的class
        // axios.post('./phpForConnect/forumCommentPost.php', formArticle).then(res => {
        //     this.commentpost = res.data;
        //     // console.log('success');
        //     // console.log(this.commentpost);
        // }),
        axios.get(`./phpForConnect/forumCommentPost.php?pageNo=${this.currentPage}&forum_post_no=${forum_post_no}`)
                    .then(res => {
                        this.commentpost = res.data.commentMessageData;
                        this.totalPage = res.data.totalPage;
                        // console.log(res.data); //測試是否成功
                        // console.log('success');
                    }),
        // 留言回覆區
        axios.post('./phpForConnect/announcement_MessageArea.php',formArticle).then(res => {
            // console.log(res.data.length);
            for (var i = 0;i<res.data.length;i++){
                this.messagearea.push(res.data[i]);
            };
            // console.log('success');
            // console.log(this.messagearea);
        })

        this.getMessagepost();

    },
    updated() {
        //回覆留言的判斷
        for(var k=0 ; k <= (this.commentpost.length-1) ; k++){
            if( $(`.MR${k}`).val()){
                $(`.MR${k}`).parent().css("display","block")
            }   else    {
                $(`.MR${k}`).parent().css("display","none")
            }
        }
        for(var k=0 ; k <= (this.commentpost.length-1) ; k++){
            if( $(`.GN${k}`).val()){
                $(`.GN${k}`).parent().css("display","block")
                // console.log($(`.GN${k}`).val())
            }   else    {
                $(`.GN${k}`).parent().css("display","none")
                // console.log($(`.GN${k}`).val())
            }
        }
        
        //這段code是判斷會員是否為登入前要做的事情
        // if($("#mem_info_id").text()){
        //     for (var t = 0; t < this.message_report_img.length; t++) {
        //         this.CHECKnull(t);
        //     }
        // }
        
        if($("#mem_info_id").text()){
            for (var t = 0; t < this.message_report_img.length; t++) {
                this.CHECKnull(t);
            }
            
            //判斷收藏
            let forum_post_no = this.issuanarea[0].forum_post_no;
            var xhr = new XMLHttpRequest();
            xhr.onload = function(e) {
                if (xhr.status == 200) { //連線成功
                    // console.log(xhr.responseText)
                        // alert(xhr.responseText);
                    if (xhr.responseText != 0) {
                        $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                    } else {
                        $(".heart").attr("src", "./images/icons/icon_heart.svg");
                    }
                } else {
                    alert(xhr.status);
                }

            }
            var url = "./phpForConnect/forum_artical_Collect_pic.php";
            xhr.open("post", url, true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
            let data = `forum_post_no=${forum_post_no}`;
            xhr.send(data);
        }

        this.checkForumReportNull();
    }, //end

    // updated() {
    //     //回覆留言的判斷
    //     for(var k=0 ; k <= (this.commentpost.length-1) ; k++){
    //         if( $(`.MR${k}`).val()){
    //             $(`.MR${k}`).parent().css("display","block")
    //         }   else    {
    //             $(`.MR${k}`).parent().css("display","none")
    //         }
    //     }
    //     for(var k=0 ; k <= (this.commentpost.length-1) ; k++){
    //         if( $(`.GN${k}`).val()){
    //             $(`.GN${k}`).parent().css("display","block")
    //             console.log($(`.GN${k}`).val())
    //         }   else    {
    //             $(`.GN${k}`).parent().css("display","none")
    //             console.log($(`.GN${k}`).val())
    //         }
    //     }
    //     for (var t = 0; t < this.message_report_img.length; t++) {
    //         this.CHECKnull(t);
    //     }
    //     //判斷收藏
    //     let forum_post_no = this.issuanarea[0].forum_post_no;
    //     var xhr = new XMLHttpRequest();
    //     xhr.onload = function(e) {
    //         if (xhr.status == 200) { //連線成功
    //             // console.log(xhr.responseText)
    //                 // alert(xhr.responseText);
    //             if (xhr.responseText != 0) {
    //                 $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
    //             } else {
    //                 $(".heart").attr("src", "./images/icons/icon_heart.svg");
    //             }
    //         } else {
    //             alert(xhr.status);
    //         }

    //     }
    //     var url = "./phpForConnect/forum_artical_Collect_pic.php";
    //     xhr.open("post", url, true);
    //     xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
    //     let data = `forum_post_no=${forum_post_no}`;
    //     xhr.send(data);
    // },
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
                }}).then(()=>{
                    axios.get(`./phpForConnect/forumCommentPost.php?pageNo=${this.currentPage}&forum_post_no=${forum_post_no}`)


                    .then(res => {
                        // this.articalList = res.data;
                        this.commentpost = res.data.commentMessageData;
                        this.totalPage = res.data.totalPage;
                        // console.log(res.data); //測試是否成功
                        // // console.log(this.commentpost)
                        // // console.log(this.totalPage)
                        // console.log('success');
                    })
                })
                this.clearTextarea();
                // this.getMessagepost();
            }

        },
        forum_artical_Collect(){
            let forum_post_no = this.issuanarea[0].forum_post_no;
            let xhr2 = new XMLHttpRequest();

            xhr2.onload = function() {
                member = JSON.parse(xhr2.responseText);
                if (member.mem_id) {
                    //已經登入了，可以開始做事了
                    var xhr = new XMLHttpRequest();
                    xhr.onload = function(e) {
                        if (xhr.status == 200) { //連線成功
                            // console.log(xhr.responseText);
                            // alert(xhr.responseText);
                        } else {
                            alert(xhr.status);
                        }
                    }
                    var url = "./phpForConnect/forum_artical_Collect.php";
                    xhr.open("post", url, true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
                    let data = `forum_post_no=${forum_post_no}`;
                    xhr.send(data);

                    if ($(".heart").attr('src') === "./images/icons/icon_heart.svg") {
                        $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                    } else {
                        $(".heart").attr("src", "./images/icons/icon_heart.svg");
                    }
                } else {
                    //沒有登入，請先登入
                    alert("請先登入哦")
                }
            }
            xhr2.open("get", "./login_v2_LoginInFo.php", true);
            xhr2.send(null);
        },
        openReportModal(e) {
            if($('#mem_info_id').html() === ''){
                alert ('請先登入');
                window.location.href = './login_v2.html';
            }else{
                // 打開彈窗
                 $('.report_block_message').removeClass('close');
                 let reportNo = $(e.target.parentNode.parentNode.parentNode.parentNode).find("input.TEMPno").val();
                //  console.log(reportNo);
                 let iconIF = $(e.target.parentNode.parentNode).find("img");
                 $(".mg_confirm").click(function(e){
                     var temp = $('#send_report_block').val();
                     if(temp == ''){
                         alert('請先輸入文字');
                     }else{
                         let comment_report_reason = $(e.target.parentNode.parentNode).find(".comment_report_reason").val();
                         axios.get('./phpForConnect/comment_message_report.php', {params:{
                             "comment_report_comment" : reportNo,
                             "comment_report_reason" : comment_report_reason,
                         }})
                         $('.mg_reporting').css('display', 'none');
                         $('.mg_be_reported').css('display', 'block');
                         iconIF.attr('src', './images/icons/icon_report_c.svg');
                     }
                 })
             }
        },
        changePic(e) {
            // console.log($(e.target).attr('src'));
            $(".public_pic > img").attr('src', $(e.target).attr('src'))
        },
        CHECKnull(k) {
            // console.log(this.message_report_img[k].comment_no);
            var CMTNO = this.message_report_img[k].comment_no;
            // console.log(CMTNO);
            // console.log(this.message_report_img[k].comment_report_mem);
            if (this.message_report_img[k].comment_report_mem !== null) {
                $(`input[value='${CMTNO}']`).parent().find(".poster-say").find(".report").find(".mg_report_bt").find("img").attr('src', './images/icons/icon_report_c.svg')
                $(`input[value='${CMTNO}']`).parent().find(".poster-say").find(".report").find(".mg_report_bt").attr("disabled", "disabled")
            };
        },
        // 加入頁碼
        getMessagepost(){
            // console.log(forum_post_no)

            // axios.get(`./phpForConnect/forumCommentPost.php?pageNo=${this.currentPage}`)
            axios.get(`./phpForConnect/forumCommentPost.php?pageNo=${this.currentPage}&forum_post_no=${forum_post_no}`)


            // axios.get(`./phpForConnect/forumPostNormal.php?pageNo=1`)
            .then(res => {
                // this.articalList = res.data;
                this.commentpost = res.data.commentMessageData;
                this.totalPage = res.data.totalPage;
                // console.log(res.data); //測試是否成功
                // console.log(this.commentpost)
                // console.log(this.totalPage)
                // console.log('success');
            })
            .catch(error => {console.log(error)}); 
        },
        changeMessagepost(page){
            this.currentPage = page;
            this.getMessagepost();
        },
    }
});
// .heart chage img src ----> 愛心收藏click(!important)
$(document).ready(function(){
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

    //click rp_close
    $('.mg_close').click(function() {
        $('.report_block_message').addClass('close');
    });

    //click cancle
    $('.mg_cancle').click(function() {
        $('.report_block_message').addClass('close');
    })
});