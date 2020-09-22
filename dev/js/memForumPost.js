//會員發佈的文章，由發布時間新到舊排序
new Vue({
    el: "#ForumPost", //html的位置 id
    data: {
        ForumPostList: [],  //BBB
        ForumPostIndex: [],  //CCC
    },

    mounted(){

        axios.get('./phpForConnect/memForumPost.php') //根據哪個php
        // axios.get(`./phpForConnect/memForumPost.php?test=${test}`)

        .then((res) => {
            this.ForumPostList = res.data; //this.BBB = res.data;

            console.log('123'); //測試是否成功
            console.log(this.ForumPostList.data); //測試是否成功
            console.log('234'); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.ForumPostList.length; i++){  //動態生成內容，依據json有幾筆
                this.ForumPostIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});