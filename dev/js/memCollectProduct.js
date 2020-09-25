//會員收藏揪團行程，由新到舊排序
new Vue({
    el: "#Collect_product", //html的位置 id
    data: {
        Collect_productList: [],  //BBB
        Collect_productIndex: [],  //CCC
        productList_porduct_no: 1,
    },
    methods: {
        delete_collect(index){
            this.productList_porduct_no = index;
            // console.log(this.productList_porduct_no);
            axios.get(`./phpForConnect/memdeleteCollect_product.php?productList_porduct_no=${this.productList_porduct_no}`)
        },
        noneCARD: function(){
            $(".Card_delete").click(function(e){
                $(e.target).parent().css("display","none")
                swal({
                    title: "已移除收藏!",
                    text: "系統已成功為您移除該商品收藏",
                    icon: "success",
                    button: "關閉",
                });
            })
        },
    },
    mounted(){
        axios.get('./phpForConnect/memCollectProduct.php') //根據哪個php
        // axios.get(`./phpForConnect/memCollectProduct.php?test=${test}`)

        .then((res) => {
            this.Collect_productList = res.data; //this.BBB = res.data;

            // console.log(res.data); //測試是否成功

            // console.log(this.meetList);
            for(let i = 0; i< this.Collect_productList.length; i++){  //動態生成內容，依據json有幾筆
                this.Collect_productIndex.push(i)
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