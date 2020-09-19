//會員收藏揪團行程，由新到舊排序
new Vue({
    el: "#Collect_product", //html的位置 id
    data: {
        Collect_productList: [],  //BBB
        Collect_productIndex: [],  //CCC
    },

    mounted(){
        axios.get('./phpForConnect/memCollectProduct.php') //根據哪個php
        // axios.get(`./phpForConnect/memCollectProduct.php?test=${test}`)

        .then((res) => {
            this.Collect_productList = res.data; //this.BBB = res.data;

            console.log(res.data); //測試是否成功

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
    // updated() {
    //     product_Collect() {
    //         let product_no = this.currentProduct.product_no;    // <------如何抓到該路徑
    //         var xhr = new XMLHttpRequest();
    //         xhr.onload = function(e) {
    //             if (xhr.status == 200) { //連線成功
    //                 console.log(xhr.responseText);
    //                 // alert(xhr.responseText);
    //             } else {
    //                 alert(xhr.status);
    //             }

    //         }
    //         var url = "./phpForConnect/memRemoveCollect_Product.php";
    //         xhr.open("post", url, true);
    //         xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
    //         let data = `product_no=${product_no}`;
    //         xhr.send(data);
    //     },
    // },
});