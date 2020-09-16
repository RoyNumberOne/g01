new Vue({
    el: "#main_forum",
    data: {
        articalList: [],
        announcement: [],
        poprank: [],
        input:{
            type:'全部',
            title: ' ',
        }
    },
    created(){
        // 公告的貼文(預設3篇)
        axios.get('./phpForConnect/forumPostAnnounce.php').then(res => {
            this.announcement = res.data;
            console.log('success');
            console.log(this.announcement);
        }),
        // 貼文(非公告)
        axios.get('./phpForConnect/forumPostNormal.php').then(res => {
            this.articalList = res.data;
            console.log('success');
            console.log(this.articalList);
        }),
        // 熱門排行榜
        axios.get('./phpForConnect/forumPostPoprank.php').then(res => {
            this.poprank = res.data;
            console.log('success');
            console.log(this.poprank);
        })
    },
    // mounted(){
    //     axios.get('./json/Initial_forum_post.json')
    //     .then((res) => {
    //         this.articalList = res.data;
    //         console.log(res.data);
    //         for(let i = 0; i< this.articalList.length; i++){
    //             this.currentIndex.push(i)
    //         }
    //     })
    //     .then(res => this.articalList = res.data)
    //     .then(res => {console.log(res.data)})

    //     .catch(error => {console.log(error)});
    // },
    methods:{

    },
    computed:{
        articleList(){
            if(this.input.type== '全部'){
                return this.articalList
             }
            else{ 
                return this.articalList.filter(artical=>{
                    return artical.forum_post_category == this.input.type
                })
            }
        },
    }
})