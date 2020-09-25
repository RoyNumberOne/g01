new Vue({
    el: '#app',
    data: {
        tourData: [],
        comments: [],
        tourParticipates: [],
        articals: [],
        passedParticipant: [],
        notPassedParticipant: [],
        message: '',
        message_report_img: [],
        tour_report_img: [],
        checkTourParticipateSituation: '',
        totalPage: '',
        currentPage: 1,
    },
    created() {

        formMessageReport = new FormData();
        urlSearchParams = (new URL(document.location)).searchParams;
        tour_no = urlSearchParams.get('tour_no');
        formMessageReport.append("tour_post_no", tour_no);

        //抓是否檢舉過某則留言，換該留言檢舉圖示
        axios.get('./phpForConnect/meet2-3_message_report_img.php', {
            params: {
                "tour_post_no": tour_no,
            }
        }).then(res => {
            this.message_report_img = res.data;
            // console.log(this.message_report_img);
        }),
        //抓是否檢舉過該團，換該團檢舉圖示
        axios.get('./phpForConnect/meet2-3_tour_report_img.php', {
            params: {
                "tour_post_no": tour_no,
            }
        }).then(res => {
            this.tour_report_img = res.data;
            // console.log(this.tour_report_img);
            // console.log(1.1)
        }),
        //抓該團目前開團狀況，後續判斷使用
        axios.get('./phpForConnect/meet2-3_tour_participate_Situation.php', {
            params: {
                "tour_participate_tour": tour_no,
            }
        })
        .then(res => {
            this.checkTourParticipateSituation = res.data;
            // console.log(this.tour_report_img);
            // console.log(1.1)
        })
    },
    mounted() {

        let formTour = new FormData();
        let urlSearchParams = (new URL(document.location)).searchParams;
        tour_no = urlSearchParams.get('tour_no');
        formTour.append("tour_no", tour_no);

        //抓本團資訊
        axios.post('./phpForConnect/meet2-3_tour.php', formTour).then(res => {
            this.tourData = res.data[0];
            this.tourData['tour_innertext']=this.tourData['tour_innertext'].replace(/\n/g,"<br>")
            // console.log('success tourData');
            // console.log(this.tourData);
        }),
        //抓留言
        // axios.post('./phpForConnect/meet2-3_comment.php', formTour).then(res => {
        //     this.comments = res.data;
        //     // console.log('success comments');
        //     // console.log(this.comments);
        // }),
        //抓審核中的人
        axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour).then(res => {
            this.tourParticipates = res.data;
            // console.log('success tourParticipats');
            // console.log(this.tourParticipates);
        }),
        //抓審核通過的人
        axios.post('./phpForConnect/meet2-3_tour_participant_passed.php', formTour).then(res => {
            this.passedParticipant = res.data;
            // console.log('success tour_participant_passed');
            // console.log(this.passedParticipant);
        }),
        //抓審核不通過的人
        axios.post('./phpForConnect/meet2-3_tour_participant_notpassed.php', formTour).then(res => {
            this.notPassedParticipant = res.data;
            // console.log('success tour_participant_notpassed');
            // console.log(this.notPassedParticipant);
        })
        let NOWtime;
        this.getCommentlist();
        this.HOST();
    },
    updated() {
        //留言檢舉第幾則
        // console.log("LENGTH" + this.message_report_img.length)
        for (var t = 0; t < this.message_report_img.length; t++) {
            this.CHECKnull(t);
        }
        // 實名制及認證class變數
        for(var k=0 ; k <= (this.comments.length-1) ; k++){
            if( $(`.GN${k}`).val()){
                $(`.GN${k}`).parent().css("display","block")
            }   else    {
                $(`.GN${k}`).parent().css("display","none")
            }
        }
        for(var k=0 ; k <= (this.comments.length-1) ; k++){
            if( $(`.MR${k}`).val()){
                $(`.MR${k}`).parent().css("display","block")
            }   else    {
                $(`.MR${k}`).parent().css("display","none")
            }
        }

        //寫完揪團記得打開
        const nowMen = this.tourData.mem_no;
        let now = new Date();
        let xhr = new XMLHttpRequest();

        xhr.open("get", "./login_v2_LoginInFo.php",true);
            xhr.send(null);
        if(this.tourData.mem_no){
            xhr.onload = ()=>{
                member = JSON.parse(xhr.responseText);
                if (member.mem_id){
                    if (nowMen !== member.mem_no){  //不同一人
                        // console.log('不同一人')
                        $('.application_bt').addClass('none')
                        $('.applied_participant').addClass('none')
                    }   else    {  //同一人
                        // console.log('同一人')
                        $('.equip_recommend').css('display', 'none')
                        $('#apply_bt').addClass('none')
                        $('#okGo').removeClass('none')
                        console.log(this.tourData.tour_min_number)
                        //提早成團
                        if(this.passedParticipant.length <= this.tourData.tour_max_number && this.passedParticipant.length >= this.tourData.tour_min_number){
                            $('#okGo').removeAttr('disabled')
                            $('#okGo').removeClass('btnB_XL_grey')
                            $('#okGo').addClass('btnB_XL_yellow')
                            $('#okGo').css('cursor', 'pointer')
                        }
                        //已成團狀態
                        if(this.tourData.tour_progress == '已截止'){
                            $('#okGo').removeClass('btnB_XL_yellow')
                            $('#okGo').addClass('btnB_XL_grey')
                            $('#okGo').css('cursor', 'not-allowed')
                            $('#okGo > p').text('已成團')
                        }
                        //時間超過活動時間
                        if(this.tourData.tour_activityend < now){
                            $('#okGo').removeAttr('disabled')
                            $('#okGo').removeClass('btnB_XL_grey')
                            $('#okGo').addClass('btnB_XL_yellow')
                            $('#okGo').css('cursor', 'pointer')
                            $('#okGo > p').text('活動已結束')
                        }
                    }
                }   
            }
        }
        //寫完揪團記得打開

        //判斷是否已結束報名
        if(this.tourData.tour_progress == '已截止'){
            $('#apply_bt > p').text('活動已截止報名')
            $('#apply_bt').attr('disabled', 'disabled')
            $('#apply_bt').removeClass('btnB_XL_yellow')
            $('#apply_bt').addClass('btnB_XL_grey')
            $('#apply_bt').css('cursor', 'not-allowed')
            $('.application_bt').css('display', 'none')
            $('.activity_application').css('display', 'none');
        }

        //判斷是否超過活動時間
        if(this.tourData.tour_activityend < now){
            $('#apply_bt > p').text('活動已結束')
            $('#apply_bt').attr('disabled', 'disabled')
            $('#apply_bt').removeClass('btnB_XL_yellow')
            $('#apply_bt').addClass('btnB_XL_grey')
            $('#apply_bt').css('cursor', 'not-allowed')
            $('.application_bt').css('display', 'none')
            $('.activity_application').css('display', 'none')
        }

        //判斷揪團是否檢舉換圖
        if($('#mem_info_id').text() != ''){
            if(this.tour_report_img[0].tour_report_mem){
                $('img.tr_report_pic').attr('src', './images/icons/icon_report_c.svg')
                $('.tr_report_bt').attr('disabled', 'disabled')
                // console.log('已檢舉')
            }   else    {
                // console.log('還沒檢舉')
            }
        }


        //判斷收藏
        let tour_no = (new URL(document.location)).searchParams;
        tour_no = urlSearchParams.get('tour_no');

        var xhr5 = new XMLHttpRequest();
        xhr5.onload = function(e) {
            if (xhr5.status == 200) { //連線成功
                if (xhr5.responseText != 0) {
                    $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                } else {
                    $(".heart").attr("src", "./images/icons/icon_heart.svg");
                }
            } else {
                swal(xhr5.status);
            }

        }
        var url = "./phpForConnect/meet_Collect_pic.php";
        xhr5.open("post", url, true);
        xhr5.setRequestHeader("content-type", "application/x-www-form-urlencoded")
        let data = `tour_no=${tour_no}`;
        xhr5.send(data);

        this.tourParticipateSituation();
        this.equipmentDisplay();
        this.hosterIsLogin();
    },
    filters: {
        Area: function(value) {
            switch (value) {
                case ('north'):
                    return '北部';
                    break;
                case ('west'):
                    return '中部';
                    break;
                case ('south'):
                    return '南部';
                    break;
                case ('east'):
                    return '東部';
                    break;
                default:
                    return '沒成功哦';
                    break;
            }
        },
    },
    computed: {
        currentTour() {
            return this.tourData;
        },
        CHECKname() {
            return this.tourData.mem_realname;
        },
        CHECKguide() {
            return this.tourData.guide_no;
        },
    },
    methods: {
        //pgprev
        pgprev(){
            this.CurrentPage - 1 ;
        },
        //pgnext
        pgnext(){
            this.CurrentPage + 1 ;      
        },
        //參加狀態
        tourParticipateSituation(){
            let situation = this.checkTourParticipateSituation;            
            switch(situation){
                case(null):
                    break;
                case('未審核'):
                    $('#apply_bt > p').text('已報名')
                    $('#apply_bt').attr('disabled', 'disabled')
                    $('#apply_bt').removeClass('btnB_XL_yellow')
                    $('#apply_bt').addClass('btnB_XL_grey')
                    $('#apply_bt').css('cursor', 'not-allowed')
                    break;
                case('已審核已通過'):
                    $('#apply_bt > p').text('審核已通過')
                    $('#apply_bt').attr('disabled', 'disabled')
                    $('#apply_bt').removeClass('btnB_XL_yellow')
                    $('#apply_bt').addClass('btnB_XL_grey')
                    $('#apply_bt').css('cursor', 'not-allowed')
                    break;
                case('已審核不通過'):
                    $('#apply_bt > p').text('審核未通過')
                    $('#apply_bt').attr('disabled', 'disabled')
                    $('#apply_bt').removeClass('btnB_XL_yellow')
                    $('#apply_bt').addClass('btnB_XL_grey')
                    $('#apply_bt').css('cursor', 'not-allowed')
                    break;
            }
        },
        //山的難度
        Degree(value) {
            switch (value) {
                case ('1'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                    break;
                case ('2'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                    break;
                case ('3'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                    break;
                case ('4'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div>';
                    break;
                default:
                    return '應該很難';
                    break;
            }
        },
        openTourApplyModal(){

            if ($('#mem_info_id').text() === '') {
                let url = window.location.href;
                localStorage.setItem('web', url);
                window.location.href = './login_v2.html';
            }else{
                $("#meet2-3-1").removeClass("close")
            }
        },
        //申請參加揪團
        applyTour() {            
            let formTour = new FormData();
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');
            formTour.append("tour_no", tour_no);

            axios.get('./phpForConnect/meet2-3_tour_apply.php', {
                params: {
                    "tour_participate_tour": tour_no,
                }
            }).then(res => {
                console.log('success apply');
                axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour).then(res => {
                    this.tourParticipates = res.data;
                })
            });
            $('#apply_bt > p').text('已報名')
            $('#apply_bt').attr('disabled', 'disabled')
            $('#apply_bt').removeClass('btnB_XL_yellow')
            $('#apply_bt').addClass('btnB_XL_grey')
            $('#apply_bt').css('cursor', 'not-allowed')
        },
        //審核同意參加
        agreeJoinTour(e) {
            let tourParticipate = $(e.target.parentNode).find("input.participate_mem_no").val();
            const nowMen = this.tourData.mem_no;
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');
            let xhr = new XMLHttpRequest();
            xhr.open("get", "./login_v2_LoginInFo.php", true);
            xhr.send(null);
            if (this.tourData.mem_no) {
                // console.log(this.passedParticipant);
                xhr.onload = ()=> {
                    member = JSON.parse(xhr.responseText);
                    // console.log(this.passedParticipant);
                    if (member.mem_id) {
                        if (nowMen == member.mem_no) {
                            let formTour = new FormData();
                            let urlSearchParams = (new URL(document.location)).searchParams;
                            tour_no = urlSearchParams.get('tour_no');
                            formTour.append("tour_no", tour_no);

                            axios.get('./phpForConnect/meet2-3_tour_apply_pass.php', {
                                params: {
                                    "tour_participate_tour": tour_no,
                                    "tour_participate_mem": tourParticipate,
                                }
                            }).then((res) => {
                                // console.log('送同意的人');
                                axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour)
                                     .then(res => {
                                            this.tourParticipates = res.data;
                                            // console.log('抓未審核的人');
                                        });
                                axios.post('./phpForConnect/meet2-3_tour_participant_passed.php', formTour)
                                     .then(res => {
                                            this.passedParticipant = res.data;
                                            // console.log('抓審核通過的人');
                                        }) 
                            })
                        }
                    }
                }
            }
        },
        //審核拒絕參加
        disareeJoinTour(e) {
            let tourParticipate = $(e.target.parentNode.parentNode).find("input.participate_mem_no").val();
            const nowMen = this.tourData.mem_no;
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');

            let xhr = new XMLHttpRequest();
            xhr.open("get", "./login_v2_LoginInFo.php", true);
            xhr.send(null);
            if (this.tourData.mem_no) {
                xhr.onload = () => {
                    member = JSON.parse(xhr.responseText);
                    if (member.mem_id) {
                        if (nowMen == member.mem_no) {
                            let formTour = new FormData();
                            let urlSearchParams = (new URL(document.location)).searchParams;
                            tour_no = urlSearchParams.get('tour_no');
                            formTour.append("tour_no", tour_no);

                            axios.get('./phpForConnect/meet2-3_tour_apply_notPass.php', {
                                params: {
                                    "tour_participate_tour": tour_no,
                                    "tour_participate_mem": tourParticipate,
                                }
                            }).then((res) => {
                                axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour)
                                     .then(res => {
                                            this.tourParticipates = res.data;
                                            // console.log('抓未審核的人');
                                        });
                                axios.post('./phpForConnect/meet2-3_tour_participant_notpassed.php', formTour)
                                     .then(res => {
                                            this.notPassedParticipant = res.data;
                                            //console.log('抓審核不通過的人');
                                        }) 
                            })
                        }
                    }
                }
            }
        },
        //提早成團
        startTour(){
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');
            let formTour = new FormData();
            formTour.append("tour_no", tour_no);
            axios.get('./phpForConnect/meet2-3_start_tour.php', {
                params: {
                    "tour_no": tour_no,
                }
            }).then(res => {
                axios.post('./phpForConnect/meet2-3_tour.php', formTour).then(res => {
                    this.tourData = res.data[0];
                })
            })
        },
        //揪團檢舉彈窗
        openTourReportModal(e) {
            if ($('#mem_info_id').text() === '') {
                let url = window.location.href;
                localStorage.setItem('web', url);
                window.location.href = './login_v2.html';
            } else {
                // 打開彈窗
                $('.report_block_match').removeClass('close');
                let reportNo = $(e.target).parent().parent().parent().parent().parent().parent().find("#report_block_match").find(".tr_reporting").find(".tour_no").val(); 
                // console.log(reportNo);
                let iconIF = $(e.target.parentNode.parentNode).find("img");
                $(".tr_confirm").click(function(e) {
                    var temp = $('#send_tr_report_block').val();
                    if (temp == '') {
                        swal('請先輸入文字');
                    } else {
                        let tour_report_reason = $(e.target).parent().parent().find(".tour_report_reason").val();
                        console.log(tour_report_reason);
                        axios.get('./phpForConnect/meet2-3_tour_report.php', {
                            params: {
                                "tour_report_tour": reportNo,
                                "tour_report_reason": tour_report_reason,
                            }
                        })
                        $('.tr_reporting').css('display', 'none');
                        $('.tr_be_reported').css('display', 'block');
                        iconIF.attr('src', './images/icons/icon_report_c.svg');
                    }
                })
            }
        },
        //送出留言後清除留言框文字
        clearTextarea() {
            this.message = '';
        },
        //判斷留言檢舉
        openMessageReportModal(e) {
            if ($('#mem_info_id').text() === '') {
                let url = window.location.href;
                localStorage.setItem('web', url);
                window.location.href = './login_v2.html';
            } else {
                // 打開彈窗
                $('.report_block_message').removeClass('close');
                let reportNo = $(e.target.parentNode.parentNode.parentNode.parentNode).find("input.TEMPno").val();
                console.log(reportNo);
                let iconIF = $(e.target.parentNode).find("img.mg_report_pic");
                $(".mg_confirm").click(function(e) {
                    var temp = $('#send_mg_report_block').val();
                    if (temp == '') {
                        swal('請先輸入文字');
                    } else {
                        let comment_report_reason = $(e.target.parentNode.parentNode).find(".comment_report_reason").val();
                        axios.get('./phpForConnect/meet2-3_message_report.php', {
                            params: {
                                "comment_report_comment": reportNo,
                                "comment_report_reason": comment_report_reason,
                            }
                        })
                        $('.mg_reporting').css('display', 'none');
                        $('.mg_be_reported').css('display', 'block');
                        iconIF.attr('src', './images/icons/icon_report_c.svg');
                    }
                })
            }
        },
        //我要開團的側邊圖
        HOST()  { 
            $(".aside-com-btn a").click(function(){
                NOWtime = new Date (Date.now())
                NOWtime = Date.parse(NOWtime);
                BANtime = Date.parse($("#BanTourDate").val());
    
                if (BANtime>NOWtime) {
                    swal(`您先前的開團已被檢舉!\n解鎖時間為:${$("#BanTourDate").val()}`)
                }   else    {
                    window.location.href = './meet2-2.html';
                }
            })
        },
        //send message
        SENDmsg() {
            NOWtime = new Date (Date.now())
            NOWtime = Date.parse(NOWtime);
            BANtime = Date.parse($("#BanCommentDate").val());

            if ($('#mem_info_id').text() === '') {
                // swal('請先登入');
                let url = window.location.href;
                localStorage.setItem('web', url);
                window.location.href = './login_v2.html';
            }   else if (BANtime>NOWtime) {
                swal(`您先前的留言已被檢舉!\n解鎖時間為:${$("#BanCommentDate").val()}`)
            } else {
                var temp = $('#send_message_block').val();
                console.log(temp)
                if (temp == '') {
                    swal('請先輸入文字');
                } else {
                    let formTour = new FormData();
                    let urlSearchParams = (new URL(document.location)).searchParams;
                    tour_no = urlSearchParams.get('tour_no');
                    formTour.append("tour_no", tour_no);

                    axios.get('./phpForConnect/meet2-3_message.php', {
                        params: {
                            "comment_class": '揪團區',
                            "tour_post_no": tour_no,
                            "comment_innertext": this.message,
                        }
                    }).then(res => {
                        // console.log('success message');
                        axios.get('./phpForConnect/meet2-3_comment.php', {
                            params: {
                                "tour_post_no": tour_no,
                                "pageNo": this.currentPage,
                            }
                        })
                        .then(res => {
                            this.comments = res.data.commentListData;
                            this.totalPage = res.data.totalPage;
                        })
                        this.clearTextarea();
                        $('html, body').animate({ scrollTop: 100000 }, 500);
                    })
                }
            }
        },
        //預覽圖片切換到大圖
        changePic(e) {
            console.log($(e.target).attr('src'));
            $(".public_pic > img").attr('src', $(e.target).attr('src'))
        },
        //確認留言是否被檢舉過
        CHECKnull(k) {
            // console.log(this.message_report_img[k].comment_no);
            var CMTNO = this.message_report_img[k].comment_no;
            // console.log(CMTNO);
            // console.log(this.message_report_img[k].comment_report_mem);
            if (this.message_report_img[k].comment_report_mem !== null) {
                $(`input[value='${CMTNO}']`).parent().find(".sent_message").find(".message_text").find(".mg_report_bt").find("img").attr('src', './images/icons/icon_report_c.svg')
                $(`input[value='${CMTNO}']`).parent().find(".sent_message").find(".message_text").find(".mg_report_bt").attr("disabled", "disabled")
            };
        },
        //確認揪團是否被檢舉過
        // checkTourReportNull() {
        //     // let tourReporter = this.tour_report_img.tour_no;
        //     if(this.tour_report_img.tour_report_mem != null){
        //         $('img.tourReportImg').attr('src', './images/icons/icon_report_c.svg')
        //         $('.tr_report_bt').attr('disabled', 'disabled')
        //     }
        // },
        //推薦裝備show or not
        equipmentDisplay() {
            if (this.tourData.tour_equip_1 == 0) {
                $('.eq1').css('display', 'none')
            }
            if (this.tourData.tour_equip_2 == 0) {
                $('.eq2').css('display', 'none')
            }
            if (this.tourData.tour_equip_3 == 0) {
                $('.eq3').css('display', 'none')
            }
            if (this.tourData.tour_equip_4 == 0) {
                $('.eq4').css('display', 'none')
            }
            if (this.tourData.tour_equip_5 == 0) {
                $('.eq5').css('display', 'none')
            }
        },
        //揪團收藏
        meet_Collect() {
            let tour_no = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function() {
                member = JSON.parse(xhr2.responseText);
                if (member.mem_id) {
                    //已經登入了，可以開始做事了
                    var xhr = new XMLHttpRequest();
                    xhr.onload = function(e) {
                        if (xhr.status == 200) { //連線成功
                            console.log(xhr.responseText);
                            // swal(xhr.responseText);
                        } else {
                            swal(xhr.status);
                        }
                    }
                    var url = "./phpForConnect/meet_Collect.php";
                    xhr.open("post", url, true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
                    let data = `tour_no=${tour_no}`;
                    xhr.send(data);

                    if ($(".heart").attr('src') === "./images/icons/icon_heart.svg") {
                        $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                    } else {
                        $(".heart").attr("src", "./images/icons/icon_heart.svg");
                    }
                } else {
                    //沒有登入，請先登入
                    swal("請先登入哦")
                }
            }
            xhr2.open("get", "./login_v2_LoginInFo.php", true);
            xhr2.send(null);
        },
        //抓留言的founction我在mounted呼叫
        getCommentlist(){

            // let formTour = new FormData();
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');
            // formTour.append("tour_no", tour_no);
            axios.get('./phpForConnect/meet2-3_comment.php', {
                params: {
                    "tour_post_no": tour_no,
                    "pageNo": this.currentPage,
                }
            })
            .then(res => {
                this.comments = res.data.commentListData;
                this.totalPage = res.data.totalPage;
            })
            .catch(error => {console.log(error)}); 
        },
        //留言換頁
        changeCommentlist(page){
            this.currentPage = page;
            this.getCommentlist();
        },
        //
        hosterIsLogin(){
            const nowMen = this.tourData.mem_no;
            let xhr = new XMLHttpRequest();
            xhr.open("get", "./login_v2_LoginInFo.php", true);
            xhr.send(null);
            if (this.tourData.mem_no) {
                xhr.onload = () => {
                    member = JSON.parse(xhr.responseText);
                    if (member.mem_id) {
                        if (nowMen == member.mem_no) {
                            $('.application_bt').css('display', 'block')
                        }
                    }
                }
            }
        }
    },
})

//apply
$(document).ready(function() {
    $('.introduction_bt').click(function() {
        $('.activity_introduction').css('display', 'block');
        $('.activity_application').css('display', 'none');
        $(this).addClass('change');
        $('.application_bt').removeClass('change');
    });
    $('.application_bt').click(function() {
        $('.activity_application').css('display', 'flex');
        $('.activity_introduction').css('display', 'none');
        $(this).addClass('change');
        $('.introduction_bt').removeClass('change');
    });


    function checkpg() {
        if ($(".pgprev").next().hasClass("-active")) {
            $(".pgprev").css("visibility", "hidden");
        } else {
            $(".pgprev").css("visibility", "visible");
        }
        if ($(".pgnext").prev().hasClass("-active")) {
            $(".pgnext").css("visibility", "hidden");
        } else {
            $(".pgnext").css("visibility", "visible");
        }
    }
    checkpg();
    $(".pg").click(function() {
        $(this).parent().children().removeClass("-active");
        $(this).addClass("-active");
        checkpg();
    });
    $(".pgprev").click(function() {
        if (!$(".pgprev").next().hasClass("-active")) {
            $(".-active").prev().addClass("-active");
            $(".-active").next(".-active").removeClass("-active");
        }
        checkpg();
    });
    $(".pgnext").click(function() {
        if (!$(".pgnext").prev().hasClass("-active")) {
            $(".-active").next().addClass("-active");
            $(".-active").prev(".-active").removeClass("-active");
        }
        checkpg();
    });

    //apply lightbox
    // $(function() {
    //     $("#apply_bt").click(function() {
    //         $("#meet2-3-1").removeClass("close");
    //     })
    // });

    $(function() {
        // 點擊不同意按鈕
        $("button#notagree").on("click", function() {
            //    console.log("click");
            $("section.agreement").removeClass("-on");
            $("section.notagree_box").addClass("-on");
        });

        // 點擊同意按鈕
        $("button#agree").on("click", function() {
            //    console.log("click");
            $("section.agreement").removeClass("-on");
            $("section.agree_box").addClass("-on");
            // $("#apply_bt > p").text("已報名");
            // $("#apply_bt").attr("disabled", "disabled");
            // $("#apply_bt").css("cursor", "not-allowed");
        });

        // 點擊X按鈕
        $("button.close_btn").on("click", function() {
            //    console.log("click");
            $("main#meet2-3-1").addClass("close");
            $(".agree_box").removeClass("-on"); //
            $(".notagree_box").removeClass("-on");
            $("section.agreement").addClass("-on");
        });
    });

    //gotop
    $(function() {
        /* 按下GoTop按鈕時的事件 */
        $('#gotop').click(function() {
            $('html,body').animate({ scrollTop: 0 }, 'slow'); /* 返回到最頂上 */
            return false;
        });

        /* 偵測卷軸滑動時，往下滑超過400px就讓GoTop按鈕出現 */
        $(window).scroll(function() {
            if ($(this).scrollTop() > 400) {
                $('#gotop').fadeIn();
            } else {
                $('#gotop').fadeOut();
            }
        });
    });

    //report match
    $(function() {
        //report lightbox
        // $('.tr_report_bt').click(function() {
        //     $('#report_block_match').removeClass('close');
        // });

        //click rp_close
        $('.rp_close').click(function() {
            $('.report_block_match').addClass('close');
        });

        //click cancle
        $('.cancle').click(function() {
            $('.report_block_match').addClass('close');
        });

        //click confirm
        // $('.tr_confirm').click(function() {
        // $('.tr_reporting').css('display', 'none');
        // $('.tr_be_reported').css('display', 'block');
        //change report img src -> not done yet
        // $('.report_pic').attr('src', './images/icons/icon_report_c.svg');
        // });
    });

    //report message
    $(function() {
        //report lightbox
        // $('.mg_report_bt').click(function() {
        //     $('.report_block_message').removeClass('close');
        // })

        //click rp_close
        $('.mg_close').click(function() {
            $('.report_block_message').addClass('close');
        });

        //click cancle
        $('.mg_cancle').click(function() {
            $('.report_block_message').addClass('close');
        })

        //click confirm
        // $('.mg_confirm').click(function() {
        //     $('.mg_reporting').css('display', 'none');
        //     $('.mg_be_reported').css('display', 'block');
        //     change report img src -> not done yet
        //     $('.mg_report_pic').attr('src', './images/icons/icon_report_c.svg');
        // });
    });

    //check login or not
    $(function() {
        $()
    })

    // submit preventDefault
    $(function() {

        // 表單的submit都會進來這兒
        $('#submit').click(function(e) {
            e.preventDefault(); // 成功阻擋Enter的submit動作!
        });
    });
})