//會員收藏文章，由新到舊排序
new Vue({
    el: "#keep_forum", //html的位置 id
    data: {
        keep_forumList: [],  //BBB
        keep_forumIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/member_v2Keepforum.php') //根據哪個php
        // axios.get(`./phpForConnect/member_v2Keepforum.php?test=${test}`)

        .then((res) => {
            this.keep_forumList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.keep_forumList.length; i++){  //動態生成內容，依據json有幾筆
                this.keep_forumIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },

});