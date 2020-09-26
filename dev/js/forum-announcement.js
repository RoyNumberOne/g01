new Vue({
    el: "#comment",
    data: {
        issuanarea:[],
        messagearea:[],
        commentpost:[],
        totalPage: 1,
        currentPage: 1,
        poster_message: '',
        message_report_img: [],
        forum_report_img: [],
        currentPage: 1,

    },
    computed:{
        CHECKname() {
            return this.issuanarea[0].mem_realname;
        },
        CHECKguide() {
            return this.issuanarea[0].guide_no;
        }
    },
    created(){
        formMessageReport = new FormData();
        urlSearchParams = (new URL(document.location)).searchParams;
        forum_post_no = urlSearchParams.get('forum_post_no');
        formMessageReport.append("forum_post_no", forum_post_no);

        //抓是否檢舉過某則留言，換該留言檢舉圖示
        axios.get('./phpForConnect/forum_comment_report_img.php', {
            params: {
                "forum_post_no": forum_post_no,
            }
        }).then(res => {
            this.message_report_img = res.data;
            // console.log(this.message_report_img);
        }),
        //抓是否檢舉過該文章，換該團檢舉圖示
        axios.get('./phpForConnect/forum_report_img.php', {
            params: {
                "forum_post_no": forum_post_no,
            }
        }).then(res => {
            this.forum_report_img = res.data;
        })
    },
    mounted() {
        let formArticle = new FormData();
        let urlSearchParams = (new URL(document.location)).searchParams;
        let LENGTH = this.message_report_img.length;
        setTimeout(() => {
            let message_report_data = this.message_report_img;

            console.log(message_report_data)
        }, 500);
        
        forum_post_no = urlSearchParams.get('forum_post_no');
        console.log(forum_post_no)
        formArticle.append("forum_post_no", forum_post_no);
        //文章發布
        axios.post('./phpForConnect/announcement_IssuanArea.php',formArticle).then(res => {
            this.issuanarea = res.data;
            // console.log(this.issuanarea[0].forum_post_innertext);
            this.issuanarea[0].forum_post_innertext = this.issuanarea[0].forum_post_innertext.replace('\n','<br/>');
            // this.issuanarea[0].forum_post_innertext=this.issuanarea[0].forum_post_innertext.replace(/\n/g,'<br>')
            //這段在vue顯示錯誤的資訊
            let forum_post_no = this.issuanarea[0].forum_post_no;
        }).then( () => {


                setTimeout(function(){

                    if($("#mem_info_id").text()){
                        
                        // for (var t = 0; t < LENGTH; t++) {
                        //     this.CHECKnull(t);
                        // }
                        
                        //判斷收藏
                            var xhr = new XMLHttpRequest();
                            xhr.onload = function(e) {
                                if (xhr.status == 200) { //連線成功
                                    console.log(xhr.responseText)
                                    // alert(xhr.responseText)
                                        // alert(xhr.responseText);
                                    if (xhr.responseText != 0) {
                                        $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                                    } else {
                                        $(".heart").attr("src", "./images/icons/icon_heart.svg");
                                    }
                                } else {
                                    swal(xhr.status);
                                }
                            }
                            var url = "./phpForConnect/forum_artical_Collect_pic.php";
                            xhr.open("post", url, true);
                            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
                            let data = `forum_post_no=${forum_post_no}`;
                            xhr.send(data);
                    }
                },500)

        }),
        this.getMessagepost();

        // 留言回覆區
        axios.post('./phpForConnect/commentPostDialog.php',formArticle).then(res => {
            // console.log(res.data.length);
            for (var i = 0;i<res.data.length;i++){
                this.dialog.push(res.data[i]);
            };
            // console.log('success');
            // console.log(this.dialog);
        })

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
                console.log($(`.GN${k}`).val())
            }   else    {
                $(`.GN${k}`).parent().css("display","none")
                console.log($(`.GN${k}`).val())
            }
        }

        this.checkForumReportNull();
        let IMGarray = $(".memberImg img")
        setTimeout(function(){
            for(var t=0 ; t<IMGarray.length ; t++){
                if(IMGarray.eq(t).width() > IMGarray.eq(t).height()){
                    IMGarray.eq(t).addClass('wide')
                    IMGarray.eq(t).removeClass('tall')
                }   else    {
                    IMGarray.eq(t).addClass('tall')
                    IMGarray.eq(t).removeClass('wide')
                }
            }
        },200)
    }, //end
    
    methods :{
        clearTextarea(){
            this.poster_message = '';
        },
        SENDmsg: function(){
            NOWtime = new Date (Date.now())
            NOWtime = Date.parse(NOWtime);
            BANtime = Date.parse($("#BanCommentDate").val());
            
            if($('#mem_info_id').html() === ''){
                // alert ('請先登入');
                let url = window.location.href;
                localStorage.setItem('web', url);
                window.location.href = './login_v2.html';
            }   else if (BANtime>NOWtime) {
                swal(`您先前的留言已被檢舉!\n解鎖時間為:${$("#BanCommentDate").val()}`)
            }   else {
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
                            console.log(xhr.responseText);
                        } else {
                            swal(xhr.status);
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
                    swal("請先登入")
                }
            }
            xhr2.open("get", "./login_v2_LoginInFo.php", true);
            xhr2.send(null);
        },
        openReportModal(e) {
            if($('#mem_info_id').html() === ''){
                swal ('請先登入');
                // window.location.href = './login_v2.html';
            }else{
                // 打開彈窗
                 $('.report_block_message').removeClass('close');
                 let reportNo = $(e.target.parentNode.parentNode.parentNode.parentNode).find("input.TEMPno").val();
                //  console.log(reportNo);
                 let iconIF = $(e.target.parentNode.parentNode).find("img");
                 $(".mg_confirm").click(function(e){
                     var temp = $('#send_report_block').val();
                     if(temp == ''){
                        swal('請先輸入文字');
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
            console.log($(e.target).attr('src'));
            $(".public_pic > img").attr('src', $(e.target).attr('src'))
        },
        //確認留言是否被檢舉過
        CHECKnull(k) {
            var CMTNO = this.message_report_img[k].comment_no;
            if (this.message_report_img[k].comment_report_mem !== null) {
                console.log(234)
                $(`input[value='${CMTNO}']`).parent().find(".poster-say").find(".report").find(".mg_report_bt").find("img").attr('src', './images/icons/icon_report_c.svg')
                $(`input[value='${CMTNO}']`).parent().find(".poster-say").find(".report").find(".mg_report_bt").attr("disabled", "disabled")
            };
        },
        //確認文章是否被檢舉過
        
        checkForumReportNull() {
            // let tourReporter = this.tour_report_img.tour_no;
            if(this.forum_report_img[0].forum_report_mem == null){
            }else{
                $('img.rpImg').attr('src', './images/icons/icon_report_c.svg')
                $('.fr_report_bt').attr('disabled', 'disabled')
                console.log('已檢舉過')
            }
        },
        //文章檢舉彈窗
        forum_artical_report(e) {
                    if ($('#mem_info_id').html() === '') {
                        swal('請先登入');
                        // window.location.href = './login_v2.html';
                    } else {
                        // 打開彈窗
                        $('.report_block_match').removeClass('close');
                        let reportNo = $('.tour_no').val();
                        console.log(reportNo)
                        let iconIF = $('.rpImg');
                        // console.log(reportNo);
                        // let iconIF = $(e.target.parentNode.parentNode).find("img");
                        $(".tr_confirm").click(function(e) {
                            var temp = $('#send_tr_report_block').val();
                            if (temp == '') {
                                swal('請先輸入文字');
                            } else {
                                let forum_report_reason = $(e.target).parent().parent().find(".tour_report_reason").val();
                                // console.log(forum_report_reason);
                                console.log(reportNo)
                                axios.get('./phpForConnect/forum_artical_report.php', {
                                    params: {
                                        "forum_report_post": reportNo,
                                        "forum_report_reason": forum_report_reason,
                                    }
                                })
                                $('.tr_reporting').css('display', 'none');
                                $('.tr_be_reported').css('display', 'block');
                                iconIF.attr('src', './images/icons/icon_report_c.svg');
                            }
                        })
                    }

        },
        // 加入頁碼
        getMessagepost(){
            let message_report_data
            setTimeout(() => {
                message_report_data = this.message_report_img;
            }, 450);

            console.log(forum_post_no)

            // axios.get(`./phpForConnect/forumCommentPost.php?pageNo=${this.currentPage}`)
            axios.get(`./phpForConnect/forumCommentPost.php?pageNo=${this.currentPage}&forum_post_no=${forum_post_no}`)

            // axios.get(`./phpForConnect/forumPostNormal.php?pageNo=1`)
            .then(res => {
                // this.articalList = res.data;
                this.commentpost = res.data.commentMessageData;
                this.totalPage = res.data.totalPage;
                console.log(res.data); //測試是否成功
                // console.log(this.commentpost)
                // console.log(this.totalPage)
            })
            .then(res => {
                setTimeout(function(){
                    if($("#mem_info_id").text()){
                        // alert($("#mem_info_id").text())
                        for (var k = 0; k < (message_report_data.length); k++) {

                            if ( message_report_data[k].comment_report_mem !== null) {
                                console.log(234)
                                $(`input[value='${message_report_data[k].comment_no}']`).parent().find(".poster-say").find(".report").find(".mg_report_bt").find("img").attr('src', './images/icons/icon_report_c.svg')
                                $(`input[value='${message_report_data[k].comment_no}']`).parent().find(".poster-say").find(".report").find(".mg_report_bt").attr("disabled", "disabled")
                            };
                        }
                    }
                },500)

            })
            .catch(error => {console.log(error)}); 
        },
        changeMessagepost(page){
            this.currentPage = page;
            this.getMessagepost();
        },
    },
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
    });

    //----------文章檢舉click點擊----------
    //click rp_close
    $('.rp_close').click(function() {
        $('.report_block_match').addClass('close');
    });

    //click cancle
    $('.cancle').click(function() {
        $('.report_block_match').addClass('close');
    });
    //report message
    $(function() {
        //click rp_close
        $('.mg_close').click(function() {
            $('.report_block_message').addClass('close');
        });
    
        //click cancle
        $('.mg_cancle').click(function() {
            $('.report_block_message').addClass('close');
        })
    });
});

//<!-- 頁碼 -->
function checkpg(){
    if ($(".pgprev").next().hasClass("-active")) {
        $(".pgprev").css("visibility","hidden");
    }   else {
        $(".pgprev").css("visibility","visible");
    }
    if ($(".pgnext").prev().hasClass("-active")) {
        $(".pgnext").css("visibility","hidden");
    }   else{
        $(".pgnext").css("visibility","visible");
    }
}

checkpg();

$(".pg").click(function(){
    $(this).parent().children().removeClass("-active");
    $(this).addClass("-active");
    checkpg();
});

$(".pgprev").click(function(){
    if (!$(".pgprev").next().hasClass("-active")) {
        $(".-active").prev().addClass("-active");
        $(".-active").next(".-active").removeClass("-active");
    }
    checkpg();
});

$(".pgnext").click(function(){
    if (!$(".pgnext").prev().hasClass("-active")) {
        $(".-active").next().addClass("-active");
        $(".-active").prev(".-active").removeClass("-active");
    }
    checkpg();
    })
});

$(function() {
    // 開團按鈕偵測是否登入
    $('.aside-com-btn').click(function (){
        if($('#mem_info_id').html() === ''){
            let url = window.location.href;
            localStorage.setItem('web', url);
            window.location.href = './login_v2.html';
        }else{
            var NOWtime = new Date (Date.now())
            NOWtime = Date.parse(NOWtime);
            var BANtime = Date.parse($("#BanTourDate").val());
    
            if (BANtime>NOWtime) {
                swal(`您先前的開團已被檢舉!\n解鎖時間為:${$("#BanTourDate").val()}`)
            }   else    {
                window.location.href = './meet2-2.html';
            }
        }
    });
});