//會員收藏揪團行程，由新到舊排序
new Vue({
    el: "#Collect_tour", //html的位置 id
    data: {
        Collect_tourList: [],  //BBB
        Collect_tourIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memCollectTour.php') //根據哪個php
        // axios.get(`./phpForConnect/memCollectTour.php?test=${test}`)

        .then((res) => {
            this.Collect_tourList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.Collect_tourList.length; i++){  //動態生成內容，依據json有幾筆
                this.Collect_tourIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});