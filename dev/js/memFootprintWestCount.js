// 會員已完成的揪團，由出團時間近到遠排序
new Vue({
    el: "#FootprintWestCount", //html的位置 id
    data: {
        FootprintWestCountList: [],  //BBB
        FootprintWestCountIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memFootprintWestCount.php') //根據哪個php
        // axios.get(`./phpForConnect/memFootprintWestCount.php?test=${test}`)

        .then((res) => {
            this.FootprintWestCountList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.FootprintWestCountList.length; i++){  //動態生成內容，依據json有幾筆
                this.FootprintWestCountIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});