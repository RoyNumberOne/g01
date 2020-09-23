// 會員已完成的揪團，由出團時間近到遠排序
new Vue({
    el: "#Accreditation", //html的位置 id
    data: {
        AccreditationList: [],  //BBB
        AccreditationIndex: [],  //CCC
    },
    mounted(){
        axios.get('./phpForConnect/memAccreditation.php') //根據哪個php
        // axios.get(`./phpForConnect/memAccreditation.php?test=${test}`)

        .then((res) => {
            this.AccreditationList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.AccreditationList.length; i++){  //動態生成內容，依據json有幾筆
                this.AccreditationIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
    methods: {
        situation(value) {
            switch(value){
                case('未審核'):
                    return '<div class="iconBox"><img src="./images/member/info_applying.jpg" title="申請審核中" class="iconSituation"></div>';
                break;
                case('已審核未通過'):
                    return '<div class="iconBox"><img src="./images/member/info_not_passed.jpg" title="申請未通過" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                break;
                case('已審核已通過'):
                    return '<div class="iconBox"><img src="./images/member/info_passed.jpg" title="申請已通過" class="iconSituation"></div>';
                break;
                default:
                    return '<div class="iconBox"><img src="./images/member/info_not_apply.jpg" title="尚未提出申請" class="iconSituation"></div>';
                break;
            }
        },
        memapplied_ID(value) {
            switch(value){
                case('未審核'):
                    return '<a href="javascript:void(0);" onclick="swal(`審核進行中！`, `您的申請正在等候審核`, `info`);"><button style="cursor: help;" class="btnB_XL_blue"><p>審核中</p><div class="bg"></div></button></a>';
                break;
                case('已審核未通過'):
                    return '<a href="./MemberId.html" target="_blank"><button class="btnB_XL_blue"><p>再次提出申請</p><div class="bg"></div></button></a>';
                break;
                case('已審核已通過'):
                    return '<a href="javascript:void(0);" onclick="swal(`恭喜您！`, `您的申請已通過審核`, `success`);"><button style="cursor: help;" class="btnB_XL_blue"><p>申請已通過！</p><div class="bg"></div></button></a>';
                break;
                default:
                    return '<a href="./MemberId.html" target="_blank"><button class="btnB_XL_blue"><p>我要申請！</p><div class="bg"></div></button></a>';
                break;
            }
        },
        memapplied_guide(value) {
            switch(value){
                case('未審核'):
                return '<a href="javascript:void(0);" onclick="swal(`審核進行中！`, `您的申請正在等候審核`, `info`);"><button style="cursor: help;" class="btnB_XL_yellow"><p>審核中</p><div class="bg"></div></button></a>';
                break;
                case('已審核未通過'):
                    return '<a href="./MemberGuide.html" target="_blank"><button class="btnB_XL_yellow"><p>再次提出申請</p><div class="bg"></div></button></a>';
                break;
                case('已審核已通過'):
                    return '<a href="javascript:void(0);" onclick="swal(`恭喜您！`, `您的嚮導認證申請已通過審核`, `success`);"><button style="cursor: help;" class="btnB_XL_yellow"><p>申請已通過！</p><div class="bg"></div></button></a>';
                break;
                default:
                    return '<a href="./MemberGuide.html" target="_blank"><button class="btnB_XL_yellow"><p>我要申請！</p><div class="bg"></div></button></a>';
                break;
            }
        }
    },
});