// 會員發起的揪團，由出團時間近到遠排序
new Vue({
    el: "#TravelBySelf", //html的位置 id
    data: {
        TravelBySelfList: [],  //BBB
        TravelBySelfIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memTravelBySelf.php') //根據哪個php
        // axios.get(`./phpForConnect/memTravelBySelf.php?test=${test}`)

        .then((res) => {
            this.TravelBySelfList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.TravelBySelfList.length; i++){  //動態生成內容，依據json有幾筆
                this.TravelBySelfIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});