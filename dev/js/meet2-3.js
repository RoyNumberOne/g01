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
    },
    created() {

        formMessageReport = new FormData();
        urlSearchParams = (new URL(document.location)).searchParams;
        tour_no = urlSearchParams.get('tour_no');
        formMessageReport.append("tour_post_no", tour_no);

        axios.get('./phpForConnect/meet2-3_message_report_img.php', {
            params: {
                "tour_post_no": tour_no,
            }
        }).then(res => {
            this.message_report_img = res.data;
            console.log(this.message_report_img);
        })

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
    updated() {
        // console.log("LENGTH" + this.message_report_img.length)
        for (var t = 0; t < this.message_report_img.length; t++) {
            this.CHECKnull(t);
        };

        //寫完揪團記得打開
        // const nowMen = this.tourData.mem_no;

        // let xhr = new XMLHttpRequest();

        // xhr.open("get", "./login_v2_LoginInFo.php",true);
        //     xhr.send(null);
        // if(this.tourData.mem_no){
        //     xhr.onload = function(){
        //         member = JSON.parse(xhr.responseText);
        //         if (member.mem_id){
        //             if (nowMen !== member.mem_no){
        //                 console.log('不同一人')
        //                 $('.application_bt').addClass('none')
        //                 $('.applied_participant').addClass('none')
        //             }   else    {
        //                 console.log('同一人')
        //                 $('.equip_recommend').css('display', 'none')
        //             };
        //         }   
        //     }
        // }
        //寫完揪團記得打開


        this.equipmentDisplay();
        // this.checkHoster();
        // console.log('111');
        // console.log(this.message_report_img);

        // if(reportNo !== ''){
        //     $('.mg_report_pic').attr('src', './images/icons/icon_report_c.svg');
        // }

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
                alert(xhr5.status);
            }

        }
        var url = "./phpForConnect/meet_Collect_pic.php";
        xhr5.open("post", url, true);
        xhr5.setRequestHeader("content-type", "application/x-www-form-urlencoded")
        let data = `tour_no=${tour_no}`;
        xhr5.send(data);
    },
    filters: {
        // var mountain_area = this.Tour1.mountain_area;
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

    },
    methods: {
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
                // axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour).then(res => {
                //     this.tourParticipates = res.data;
                // })
            });
        },
        agreeJoinTour(e) {
            let tourParticipate = $(e.target.parentNode).find("input.participate_mem_no").val();
            alert(tourParticipate);
            const nowMen = this.tourData.mem_no;
            // let formTour = new FormData();
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');
            // formTour.append("tour_no", tour_no);    
            // formTour.append("tour_participate_mem", tourParticipate);

            let xhr = new XMLHttpRequest();
            xhr.open("get", "./login_v2_LoginInFo.php", true);
            xhr.send(null);
            if (this.tourData.mem_no) {
                xhr.onload = function() {
                    member = JSON.parse(xhr.responseText);
                    if (member.mem_id) {
                        if (nowMen == member.mem_no) {
                            // console.log('同一人')

                            let formTour = new FormData();
                            let urlSearchParams = (new URL(document.location)).searchParams;
                            tour_no = urlSearchParams.get('tour_no');
                            formTour.append("tour_no", tour_no);

                            axios.get('./phpForConnect/meet2-3_tour_apply_pass.php', {
                                    params: {
                                        "tour_participate_tour": tour_no,
                                        "tour_participate_mem": tourParticipate,

                                    }
                                })
                                // .then(res => {
                                //     axios.post('./phpForConnect/meet2-3_tour_participant_passed.php', formTour).then(res => {
                                //         this.passedParticipant = res.data;
                                //         console.log('ohohoh')
                                //     })
                                // });
                                .then(() => {
                                    axios.post('./phpForConnect/meet2-3_tour_participant_passed.php', formTour)
                                        .then(res => {
                                            this.passedParticipant = res.data;
                                            console.log('success 333');
                                        })
                                })
                                .then(() => {
                                    axios.post('./phpForConnect/meet2-3_tour_participate.php', formTour)
                                        .then(res => {
                                            this.tourParticipates = res.data;
                                            console.log('success 333');
                                        })
                                })
                        }
                    }
                }
            }
        },
        disareeJoinTour(e) {
            let tourParticipate = $(e.target.parentNode.parentNode).find("input.participate_mem_no").val();
            alert(tourParticipate);
            const nowMen = this.tourData.mem_no;
            let urlSearchParams = (new URL(document.location)).searchParams;
            tour_no = urlSearchParams.get('tour_no');

            let xhr = new XMLHttpRequest();
            xhr.open("get", "./login_v2_LoginInFo.php", true);
            xhr.send(null);
            if (this.tourData.mem_no) {
                xhr.onload = function() {
                    member = JSON.parse(xhr.responseText);
                    if (member.mem_id) {
                        if (nowMen == member.mem_no) {
                            // console.log('同一人')

                            axios.get('./phpForConnect/meet2-3_tour_apply_notPass.php', {
                                params: {
                                    "tour_participate_tour": tour_no,
                                    "tour_participate_mem": tourParticipate,
                                }
                            })
                        }
                    }
                }
            }
        },
        clearTextarea() {
            this.message = '';
        },
        openReportModal(e) {
            if ($('#mem_info_id').html() === '') {
                alert('請先登入');
                window.location.href = './login_v2.html';
            } else {
                // 打開彈窗
                $('.report_block_message').removeClass('close');
                let reportNo = $(e.target.parentNode.parentNode.parentNode.parentNode).find("input.TEMPno").val();
                console.log(reportNo);
                let iconIF = $(e.target.parentNode).find("img");
                $(".mg_confirm").click(function(e) {
                    var temp = $('#send_report_block').val();
                    if (temp == '') {
                        alert('請先輸入文字');
                    } else {
                        let comment_report_reason = $(e.target.parentNode.parentNode).find(".comment_report_reason").val();
                        // formMessageReport = new FormData();
                        // formMessageReport.append("comment_report_comment", reportNo)
                        // formMessageReport.append("comment_report_reason", comment_report_reason)
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
        //send message
        SENDmsg() {
            if ($('#mem_info_id').html() === '') {
                alert('請先登入');
                let url = window.location.href;
                localStorage.setItem('web', url);
                window.location.href = './login_v2.html';
            } else {
                var temp = $('#send_message_block').val();
                console.log(temp)
                if (temp == '') {
                    alert('請先輸入文字');
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
                        console.log('success message');
                        axios.post('./phpForConnect/meet2-3_comment.php', formTour).then(res => {
                            this.comments = res.data;
                            this.clearTextarea();
                            $('html, body').animate({ scrollTop: 100000 }, 500);
                        })
                    });
                }
            }
        },
        changePic(e) {
            console.log($(e.target).attr('src'));
            $(".public_pic > img").attr('src', $(e.target).attr('src'))
        },
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
                            // alert(xhr.responseText);
                        } else {
                            alert(xhr.status);
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
                    alert("請先登入哦")
                }
            }
            xhr2.open("get", "./login_v2_LoginInFo.php", true);
            xhr2.send(null);
        },


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
    $(function() {
        $("#apply_bt").click(function() {
            $("#meet2-3-1").removeClass("close");
        })
    });

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
            $("#apply_bt > p").text("已報名");
            $("#apply_bt").attr("disabled", "disabled");
            $("#apply_bt").css("cursor", "not-allowed");
            $("#apply_bt > .bg").css("backgroundColor", "gray");
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
        // $('.report_bt').click(function() {
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
        // $('.confirm').click(function() {
        // $('.reporting').css('display', 'none');
        // $('.be_reported').css('display', 'block');
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