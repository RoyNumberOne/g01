new Vue({
    el: "#main_forum",
    data: {
        articalList: [],
        announcement: [],
        poprank: [],
        meetList: [],
        meetIndex: [],
        input:{
            type:'全部',
            title: ' ',
        }
    },
    computed:{
        CHECKname() {
            return this.articalList[0].mem_realname;
        },
        CHECKguide() {
            return this.articalList[0].guide_no;
        },
        forumpost(){
            if(this.input.type== '全部'){
                return this.articalList
             }
            else{ 
                return this.articalList.filter(artical=>{
                    return artical.forum_post_category == this.input.type
                })
            }
        },
        searchbar(){
            if(this.input.title){
                return this.forumpost.filter(artical =>{
                  var content = artical.forum_post_title.toLowerCase()
                  var keyword = this.input.title.toLowerCase()
                    return content.indexOf(keyword) !== -1;
                });
              }
              else{
                return this.forumpost;
              }
        },
    },
    mounted(){
        //axios.get('./json/Initial_tour.json') //根據哪個json
        axios.get('./phpForConnect/meet2-0Hotmeet.php')

        .then((res) => {
            this.meetList = res.data;

            console.log(res.data); //測試是否成功
            // console.log(this.meetList);
            for(let i = 0; i< this.meetList.length; i++){  //動態生成內容，依據json有幾筆
                this.meetIndex.push(i)
            }
        })
        .catch(error => {console.log(error)}); 
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
        // axios.get('./phpForConnect/meet2-0Hotmeet.php').then(res => {
        //     this.hotmeet = res.data;
        //     console.log('success');
        //     console.log(this.hotmeet);
        // })
        
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
        // AFTERsearch: function(){
        //     $(".forum-block").html("");
        // },
    },
})