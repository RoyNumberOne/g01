new Vue({
    el: '#app',
    data: {
        tourData: [],
        comments: [
            {
                comment_no: 1,
                comment_innertext: 'test',
                comment_poster: 'Zoe',
                comment_time: '2020/07/13/20:30',
            },
            {
                comment_no: 1,
                comment_innertext: 'test2',
                comment_poster: 'Zoe2',
                comment_time: '2020/07/13/20:30',
            },
            {
                comment_no: 1,
                comment_innertext: 'test3',
                comment_poster: 'Zoe3',
                comment_time: '2020/07/13/20:30',
            }
        ],
        reportNo: null,
    },
    mounted() {
        axios.get('./phpForConnect/meet2-3.php').then(res => {
            this.tourData = res.data;
            console.log('success');
            console.log(this.tourData);
        }),
        axios.get('./phpForConnect/meet2-3_comment.php').then(res => {
            this.comments = res.data;
            console.log('success');
            console.log(this.comments);
        })
    },
    computed: {
        currentTour(){
            return this.tourData[0];
        }
    },
    methods: {
        openReportModal(commentId) {
            this.reportNo = commentId;
            // 打開彈窗
            $(function() {
                //report lightbox
                $('.mg_report_bt').click(function() {
                    $('#report_block_message').removeClass('close');
                })
            
                //click rp_close
                $('.mg_close').click(function() {
                    $('#report_block_message').addClass('close');
                })
                
                //click cancle
                $('.mg_cancle').click(function() {
                    $('#report_block_message').addClass('close');
                })
            
                //click confirm
                $('.mg_confirm').click(function() {
                    $('.mg_reporting').css('display', 'none');
                    $('.mg_be_reported').css('display', 'block');
                    $('.mg_report_pic').attr('src', './images/icons/icon_report_c.svg');
                })
            })
        },
    },
})

//apply
$(document).ready(function (){
    $('.introduction_bt').click(function(){
        $('.activity_introduction').css('display','block');
        $('.activity_application').css('display','none');
        $(this).addClass('change');
        $('.application_bt').removeClass('change');
    });
    $('.application_bt').click(function(){
        $('.activity_application').css('display','block');
        $('.activity_introduction').css('display','none');
        $(this).addClass('change');
        $('.introduction_bt').removeClass('change');
    });
    
    
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
    });
    
    // lightbox
    $(function(){
        $("#apply_bt").click(function(){
            $("#meet2-3-1").removeClass("close");
        })
    });
    
    $(function() {
        // 點擊不同意按鈕
        $("button#notagree").on("click", function(){
         //    console.log("click");
            $("section.agreement").removeClass("-on");
            $("section.notagree_box").addClass("-on");
        });
    
         // 點擊同意按鈕
        $("button#agree").on("click", function(){
         //    console.log("click");
            $("section.agreement").removeClass("-on");
            $("section.agree_box").addClass("-on");
            $("#apply_bt > p").text("已報名");
        });
    
        // 點擊X按鈕
        $("button.close_btn").on("click", function(){
         //    console.log("click");
            $("main#meet2-3-1").addClass("close");
            $(".agree_box").removeClass("-on");//
            $(".notagree_box").removeClass("-on");
            $("section.agreement").addClass("-on");
        });
    });
    
    //gotop
    $(function() {
        /* 按下GoTop按鈕時的事件 */
        $('#gotop').click(function(){
            $('html,body').animate({ scrollTop: 0 }, 'slow');   /* 返回到最頂上 */
            return false;
        });
        
        /* 偵測卷軸滑動時，往下滑超過400px就讓GoTop按鈕出現 */
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 400){
                $('#gotop').fadeIn();
            } else {
                $('#gotop').fadeOut();
            }
        });
    });
    
    //report match
    $(function() {
        //report lightbox
        $('.report_bt').click(function() {
            $('#report_block_match').removeClass('close');
        })
    
        //click rp_close
        $('.rp_close').click(function() {
            $('#report_block_match').addClass('close');
        });
        
        //click cancle
        $('.cancle').click(function() {
            $('#report_block_match').addClass('close');
        })
    
        //click confirm
        $('.confirm').click(function() {
            $('.reporting').css('display', 'none');
            $('.be_reported').css('display', 'block');
            $('.report_pic').attr('src', './images/icons/icon_report_c.svg');
        });
    });
    
    //report message
    // $(function() {
    //     //report lightbox
    //     $('.mg_report_bt').click(function() {
    //         $('#report_block_message').removeClass('close');
    //     })
    
    //     //click rp_close
    //     $('.mg_close').click(function() {
    //         $('#report_block_message').addClass('close');
    //     });
        
    //     //click cancle
    //     $('.mg_cancle').click(function() {
    //         $('#report_block_message').addClass('close');
    //     })
    
    //     //click confirm
    //     $('.mg_confirm').click(function() {
    //         $('.mg_reporting').css('display', 'none');
    //         $('.mg_be_reported').css('display', 'block');
    //         $('.mg_report_pic').attr('src', './images/icons/icon_report_c.svg');
    //     });
    // });
    
    //heart
    $(function() {
        $(".heart").click(function(){
            if($(".heart").attr('src') === "./images/icons/icon_heart.svg"){
                $(".heart").attr("src","./images/icons/icon_heart_h&c.svg");
            }else{
                $(".heart").attr("src","./images/icons/icon_heart.svg");
            }
        });
    });
})    
