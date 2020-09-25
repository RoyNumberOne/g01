// 會員已完成的揪團，由出團時間近到遠排序
new Vue({
    el: "#FootprintSouthCount", //html的位置 id
    data: {
        FootprintSouthCountList: [],  //BBB
        FootprintSouthCountIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memFootprintSouthCount.php') //根據哪個php
        // axios.get(`./phpForConnect/memFootprintSouthCount.php?test=${test}`)

        .then((res) => {
            this.FootprintSouthCountList = res.data; //this.BBB = res.data;

            // console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.FootprintSouthCountList.length; i++){  //動態生成內容，依據json有幾筆
                this.FootprintSouthCountIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});