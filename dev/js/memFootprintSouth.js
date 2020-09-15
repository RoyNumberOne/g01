// 會員已完成的揪團，由出團時間近到遠排序
new Vue({
    el: "#FootprintSouth", //html的位置 id
    data: {
        FootprintSouthList: [],  //BBB
        FootprintSouthIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memFootprintSouth.php') //根據哪個php
        // axios.get(`./phpForConnect/memFootprintSouth.php?test=${test}`)

        .then((res) => {
            this.FootprintSouthList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.FootprintSouthList.length; i++){  //動態生成內容，依據json有幾筆
                this.FootprintSouthIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});