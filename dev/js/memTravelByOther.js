// 會員參加的揪團，由出團時間近到遠排序
new Vue({
    el: "#TravelByOther", //html的位置 id
    data: {
        TravelByOtherList: [],  //BBB
        TravelByOtherIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memTravelByOther.php') //根據哪個php
        // axios.get(`./phpForConnect/memTravelByOther.php?test=${test}`)

        .then((res) => {
            this.TravelByOtherList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.TravelByOtherList.length; i++){  //動態生成內容，依據json有幾筆
                this.TravelByOtherIndex.push(i)
            }
            // for(let i = 0; i< this.BBB.length; i++){  
            //     this.CCC.push(i)
            // }

        })
        .catch(error => {console.log(error)}); 
    },
    filters: {
        // var mountain_area = this.Tour1.mountain_area;
        Area: function(value) {
            switch(value){
                case('north'):
                    return '北部';
                break;
                case('west'):
                    return '中部';
                break;
                case('south'):
                    return '南部';
                break;
                case('east'):
                    return '東部';
                break;
                default:
                    return '沒成功哦';
                break;
            }
        }
    }
});