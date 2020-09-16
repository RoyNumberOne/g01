new Vue({
    el: '#app',
    data: {
        // hosterData: [],
        tourData: [],
        comments: [],
        tourParticipates: [],
        articals: [],
        passedParticipant: [],
        notPassedParticipant: [],
    },
    mounted() {

        let formTour = new FormData();

        let urlSearchParams = (new URL(document.location)).searchParams;
        tour_no = urlSearchParams.get('tour_no');
        formTour.append("tour_no", tour_no);        

        axios.post('./phpForConnect/meet2-3_tour.php', formTour).then(res => {
            this.tourData = res.data[0];
            console.log('success tourData');
            console.log(this.tourData);
        }),
        axios.post('./phpForConnect/meet2-3_comment.php', formTour).then(res => {
            this.comments = res.data;
            console.log('success comments');
            console.log(this.comments);
        }),
        axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour).then(res => {
            this.tourParticipates = res.data;
            console.log('success tourParticipats');
            console.log(this.tourParticipates);
        }),
        axios.post('./phpForConnect/meet2-3_tour_participant_passed.php', formTour).then(res => {
            this.passedParticipant = res.data;
            console.log('success tour_participant_passed');
            console.log(this.passedParticipant);
        }),
        axios.post('./phpForConnect/meet2-3_tour_participant_notpassed.php', formTour).then(res => {
            this.notPassedParticipant = res.data;
            console.log('success tour_participant_notpassed');
            console.log(this.notPassedParticipant);
        })
        // axios.get('./phpForConnect/meet2-3_artical.php').then(res => {
        //     this.articals = res.data;
        //     console.log('success articals');
        //     console.log(this.articals);
        // })
    },
    filters: {
        // var mountain_area = this.Tour1.mountain_area;
        Area: function(value) {
            switch(value){
                case('north'):
                    return '北部';
                break;
                case('west'):
                    return '中部';
                break;
                case('south'):
                    return '南部';
                break;
                case('east'):
                    return '東部';
                break;
                default:
                    return '沒成功哦';
                break;
            }
        },
    },
    computed: {
        currentTour(){
            return this.tourData;
        },
    },
    methods: {
        // openReportModal(commentId) {
        //     this.reportNo = commentId;
        //     // 打開彈窗
        // }
        // days(){
        //     this.currentTour.tour_activityend - this.currentTour.tour_activitystart;
        // }
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
        $('.activity_application').css('display','flex');
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
    $(function() {
        //report lightbox
        $('.mg_report_bt').click(function() {
            $('#report_block_message').removeClass('close');
        })
    
        //click rp_close
        $('.mg_close').click(function() {
            $('#report_block_message').addClass('close');
        });
        
        //click cancle
        $('.mg_cancle').click(function() {
            $('#report_block_message').addClass('close');
        })
    
        //click confirm
        $('.mg_confirm').click(function() {
            $('.mg_reporting').css('display', 'none');
            $('.mg_be_reported').css('display', 'block');
            $('.mg_report_pic').attr('src', './images/icons/icon_report_c.svg');
        });
    });
    
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

    //tour_no
    // $(function() {
    //     let urlSearchParams = (new URL(document.location)).searchParams;
    //     tour_no = urlSearchParams.get('tour_no');
    //     let formTour = new FormData;
    //     let test = formTour.append('tour_no', tour_no);
    //     console.log(test);
    // })
})    
