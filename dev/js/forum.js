new Vue({
    el: "#main_forum",
    data: {
        articalList: [],
        announcement: [],
        poprank: [],
        meetList: [],
        meetIndex: [],
        totalPage: 5,
        currentPage: 1,
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
    filters: {
        Area (value) {
            switch (value) {
                case ('north'):
                    return '北部';
                    break;
                case ('west'):
                    return '中部';
                    break;
                case ('south'):
                    return '南部';
                    break;
                case ('east'):
                    return '東部';
                    break;
                default:
                    return '沒成功哦';
                    break;
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
        
        this.getForumpostlist();
    },
    created(){
        
        // 公告的貼文(預設3篇)
        axios.get('./phpForConnect/forumPostAnnounce.php').then(res => {
            this.announcement = res.data;
            console.log('success');
            console.log(this.announcement);
        }),
        // // 貼文(非公告)
        // axios.get('./phpForConnect/forumPostNormal.php').then(res => {
        //     this.articalList = res.data;
        //     console.log('success');
        //     console.log(this.articalList);
        // }),

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
        
        //山的難度
        Degree(value) {
            switch (value) {
                case ('1'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                    break;
                case ('2'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                    break;
                case ('3'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain_a.svg" alt="" class="iconDegree"></div>';
                    break;
                case ('4'):
                    return '<div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div><div class="iconBox"><img src="./images/icons/icon_mountain.svg" alt="" class="iconDegree"></div>';
                    break;
                default:
                    return '應該很難';
                    break;
            }
        },
         // 貼文(非公告)
        getForumpostlist(){
            axios.get(`./phpForConnect/forumPostNormal.php?pageNo=${this.currentPage}`)
            // axios.get(`./phpForConnect/forumPostNormal.php?pageNo=1`)
            .then(res => {
                // this.articalList = res.data;
                this.articalList = res.data.forumListData;
                this.totalPage = res.data.totalPage;
                console.log(res.data); //測試是否成功
            })
            .catch(error => {console.log(error)}); 
        },
        changeForumpostlist(page){
            this.currentPage = page;
            this.getForumpostlist();
        },
    },
    //響導認證及會員認證的icon
    updated() {
        for(var k=0; k<= (this.poprank.length-1); k++){
            if( $(`.MR${k}`).val() ){
                $(`.MR${k}`).parent().css("display","block")
            }else{
                $(`.MR${k}`).parent().css("display","none")
            }
        }
        for(var k=0; k<= (this.poprank.length-1); k++){
            if( $(`.GN${k}`).val() ){
                $(`.GN${k}`).parent().css("display","block")
            }else{
                $(`.GN${k}`).parent().css("display","none")
            }
        }
        //討論區首頁文章排序(響導認證及會員認證)
        for(var k=0; k<= (this.articalList.length-1); k++){
            if( $(`.belowMR${k}`).val() ){
                console.log(`YYYY${k}`)
                $(`.belowMR${k}`).parent().css("display","block")
            }else{
                console.log(`NNNN${k}`)
                $(`.belowMR${k}`).parent().css("display","none")
            }
        }
        for(var k=0; k<= (this.articalList.length-1); k++){
            if( $(`.belowGN${k}`).val() ){
                $(`.belowGN${k}`).parent().css("display","block")
            }else{
                $(`.belowGN${k}`).parent().css("display","none")
            }
        }
    },
})

//<!-- 頁碼 -->
function checkpg(){
    if ($(".pgprev").next().hasClass("-active")) {
        $(".pgprev").css("visibility","hidden");
    }   else {
        $(".pgprev").css("visibility","visible");
    }
    if ($(".pgnext").prev().hasClass("-active")) {
        $(".pgnext").css("visibility","hidden");
    }   else{
        $(".pgnext").css("visibility","visible");
    }
}

checkpg();

$(".pg").click(function(){
    $(this).parent().children().removeClass("-active");
    $(this).addClass("-active");
    checkpg();
});

$(".pgprev").click(function(){
    if (!$(".pgprev").next().hasClass("-active")) {
        $(".-active").prev().addClass("-active");
        $(".-active").next(".-active").removeClass("-active");
    }
    checkpg();
});

$(".pgnext").click(function(){
    if (!$(".pgnext").prev().hasClass("-active")) {
        $(".-active").next().addClass("-active");
        $(".-active").prev(".-active").removeClass("-active");
    }
    checkpg();
});