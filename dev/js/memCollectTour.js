//會員收藏揪團行程，由新到舊排序
new Vue({
    el: "#Collect_tour", //html的位置 id
    data: {
        Collect_tourList: [],  //BBB
        Collect_tourIndex: [],  //CCC
        tourList_tour_no: 1,
    },

    methods: {
        delete_collect(index){

            this.tourList_tour_no = index;
            // console.log(this.tourList_tour_no);
            axios.get(`./phpForConnect/memdeleteCollect_tour.php?tourList_tour_no=${this.tourList_tour_no}`)
            
            
        },
        noneCARD: function(){
            $(".Card_delete").click(function(e){
                $(e.target).parent().css("display","none")
            })
        },
        

    },

    mounted(){
        axios.get('./phpForConnect/memCollectTour.php') //根據哪個php

        .then((res) => {
            this.Collect_tourList = res.data; 

            console.log(res.data); 

            for(let i = 0; i< this.Collect_tourList.length; i++){
                this.Collect_tourIndex.push(i)
            }

        })
        .catch(error => {console.log(error)}); 
    },
    updated() {
        this.noneCARD();
    },
});