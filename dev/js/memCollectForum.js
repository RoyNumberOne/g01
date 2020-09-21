//會員收藏文章，由新到舊排序
new Vue({
    el: "#Collect_forum", //html的位置 id
    data: {
        Collect_forumList: [],  //BBB
        Collect_forumIndex: [],  //CCC
        forumList_forum_post_no: 1,
    },

    methods: {
        delete_collect(index){
            this.forumList_forum_post_no = index;
            // console.log(this.forumList_forum_post_no);
            axios.get(`./phpForConnect/memdeleteCollect_forum.php?forumList_forum_post_no=${this.forumList_forum_post_no}`)
        },
        noneCARD: function(){
            $(".Card_delete").click(function(e){
                $(e.target).parent().css("display","none")
                swal({
                    title: "已移除收藏!",
                    text: "系統已成功為您移除該文章收藏",
                    icon: "success",
                    button: "關閉",
                });
            })
        },
    },
    mounted(){
        axios.get('./phpForConnect/memCollectForum.php') //根據哪個php
        // axios.get(`./phpForConnect/memCollectForum.php?test=${test}`)

        .then((res) => {
            this.Collect_forumList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.Collect_forumList.length; i++){  //動態生成內容，依據json有幾筆
                this.Collect_forumIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
    updated() {
        this.noneCARD();
    },
});