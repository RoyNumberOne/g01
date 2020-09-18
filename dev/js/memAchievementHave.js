new Vue({
    el: "#AchievementHave", //html的位置 id
    data: {
        AchievementHaveList: [],  //BBB
        AchievementHaveIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memAchievementHave.php') //根據哪個php
        // axios.get(`./phpForConnect/memAchievementHave.php?test=${test}`)

        .then((res) => {
            this.AchievementHaveList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.AchievementHaveList.length; i++){  //動態生成內容，依據json有幾筆
                this.AchievementHaveIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
    methods: {
        checkMA: function(){
            for(var i = 0 ; i<15 ; i++){
                console.log(this.AchievementHaveList[i].mem_no)
                if(this.AchievementHaveList[i].mem_no){
                    $("#AchievementHave").children().eq(`${i}`).removeClass("Nohave");
                }
            }
        }
    },
    updated() {
        this.checkMA();
    },
});