//會員收藏文章，由新到舊排序
new Vue({
    el: "#Favorites_forum", //html的位置 id
    data: {
        Favorites_forumList: [],  //BBB
        Favorites_forumIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memFavoritesForum.php') //根據哪個php
        // axios.get(`./phpForConnect/memFavoritesForum.php?test=${test}`)

        .then((res) => {
            this.Favorites_forumList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.Favorites_forumList.length; i++){  //動態生成內容，依據json有幾筆
                this.Favorites_forumIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
});