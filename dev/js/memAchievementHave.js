new Vue({
    el: "#MemAchievement", //html的位置 id
    data: {
        AchievementHaveList: [],  //BBB
        AchievementHaveIndex: [],  //CCC
        NowBadge: []
    },

    mounted(){
        axios.get('./phpForConnect/memAchievementHave.php') //根據哪個php
        // axios.get(`./phpForConnect/memAchievementHave.php?test=${test}`)

        .then((res) => {
            this.AchievementHaveList = res.data; //this.BBB = res.data;

            // console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.AchievementHaveList.length; i++){  //動態生成內容，依據json有幾筆
                this.AchievementHaveIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 

        // 使用中徽章
        axios.get('./phpForConnect/memNowBadge.php')
        .then((res) => {
            this.NowBadge = res.data[0]; 
            // console.log(this.NowBadge[0])
        }).then(()=>{
            this.badgespace();
            this.newbadge();
        }).
        catch(error => {console.log(error)}); 

        let badgespace;
        let newbadge;
        let newbadgep;
        let newbadgesrc;
        let nowbadge1name;
        let nowbadge2name;
        let nowbadge3name;
        let alerted;

    },
    methods: {
        checkMA: function(){
            for(var i = 0 ; i<15 ; i++){
                // console.log(this.AchievementHaveList[i].mem_no)
                if(this.AchievementHaveList[i].mem_no){
                    $("#AchievementHave").children().eq(`${i}`).removeClass("Nohave");
                    $("#AchievementHave").children().eq(`${i}`).children("img").addClass("Having");
                }
            }
        },
        badgespace: function(){

            alerted = 0;

            nowbadge1name = this.NowBadge.name1;
            nowbadge2name = this.NowBadge.name2;
            nowbadge3name = this.NowBadge.name3;
            $(".badgespace").click(function(e){
                badgespace = $(e.target).attr('class');
                badgespace = badgespace.substr(8,1);
                if (nowbadge1name === null && nowbadge2name === null && nowbadge3name === null && alerted == 0 ){
                    swal("系統通知", "請點擊下方已解鎖的徽章進行更換！", "info"); 
                    alerted = alerted + 1 ;
                }
            })
        },
        newbadge: function(){
            $(".Having").click(function(e){
                newbadge = $(e.target).attr('class');
                newbadge = newbadge.substr(5,2);
                newbadgep = $(e.target).next('p').text();
                newbadgesrc= $(e.target).attr('src')
                if(badgespace){
                    if(newbadge){
                        $(`.using${badgespace}`).find('img').attr('src',newbadgesrc)
                        $(`.using${badgespace}`).find('p').text(newbadgep)
                        $.ajax({
                            url: './phpForConnect/UpdateBadge.php',
                            data: {	badgespace: badgespace,
                                    newbadge: newbadge 
                                },
                            type: 'POST',   
                            success(){
                                
                            } ,
                        });
                    };
                };
            });
        },
    },
    updated() {
        this.checkMA();
    },
});