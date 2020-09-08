
// 最新揪團
new Vue({
    el: "#newMeetItem",
    data: {
        meetlList: [],
        meetIndex: 0,   //[]
    },

    mounted(){
        axios.get('./json/Initial_tour.json') //根據哪個json
        
        .then((res) => {
            this.meetlList = res.data;

            console.log(res.data); //測試是否成功

            // for(let i = 0; i< this.meetlList.length; i++){  //動態生成內容，依據json有幾筆
            //     this.meetIndex.push(i)
            // }
        })
        .catch(error => {console.log(error)}); 
    },

});

/* <div id="forum_list" v-for="(artical, index) in articalList" class="rest02">
<div class="forum_post_image">
    <img :src="artical.forum_post_image" alt="">
</div>
<div class="forum-infor">
    <a href="./comment.html">
        <div class="tittle">
            <h3>{{artical.forum_post_title}}</h3>
            <div class="innertext">
                <p>
                    {{artical.forum_post_innertext}}
                </p>
            </div> 
*/


// 更換Card  list樣式          
$(function() {
    //click
    

    // 點擊按鈕typeCard
    $("div.typeCard").on("click", function(){
        // div.newMeetActivity
            //移除 list 樣式
        $("div.newMeetActivity").removeClass("list");
        $(".newMeet div.member_styleA").removeClass("column");
            // 加上 card 樣式
        $("div.newMeetActivity").addClass("card");
        $(".newMeet div.member_styleA").addClass("row");
        
        //btn
        $("div.typeList").removeClass("-on");
        $("div.typeCard").addClass("-on");
    });

    // 點擊按鈕typeList
    $("div.typeList").on("click", function(){
        // div.newMeetActivity
            //移除 card 樣式
        $("div.newMeetActivity").removeClass("card");
        $(".newMeet div.member_styleA").removeClass("row");
            //加上 list 樣式
        $("div.newMeetActivity").addClass("list");
        $(".newMeet div.member_styleA").addClass("column");

        //btn
        $("div.typeCard").removeClass("-on");
        $("div.typeList").addClass("-on");
    });
});
        


