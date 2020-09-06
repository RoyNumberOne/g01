new Vue({
    el: '#app',
    data: {
        products:[{}],
        currentIndex: 0 ,
        currentImageIndex: 0,
        addCount: 0,
        productCount: 1,
        productList:'',
    },
    mounted(){
        axios.get('./json/Initial_product.json')

            .then((res) => {
                this.products = res.data;
                console.log(res.data);
            })
        
            // .then(res => this.products = res.data)
            // .then(res => {console.log(res.data)})
            .catch(error => {console.log(error)});
        
        if(localStorage.getItem('productList')){
            try{
                this.cat = JSON.parse(`[${localStorage.getItem('productList')}]`);
                console.log(JSON.parse(`[${this.productList}]`));
            }catch(e){
                localStorage.removeItem('productList');
            }
        };
    },
    computed: {
        productsCount() {
            return this.products.length;
        },
        currentProduct() { // use this to show current product
            return this.products[this.currentIndex];
        },
        nextProduct() {
            return this.products[this.nextIndex];
        },
        preProduct() {
            return this.products[this.preIndex];
        },
        nextIndex() {
        if (this.currentIndex === this.productsCount -1) { // current product is the last product
                return 0;
            } else {
                return this.currentIndex + 1;
            }
        },
        preIndex() {
            if (this.currentIndex === 0) { // current product is the first product
                return this.productsCount - 1;
            } else {
                return this.currentIndex - 1;
            }
        },
        currentImage(){
            switch(this.currentImageIndex){
                case 0: 
                return  this.currentProduct.product_image1;
                case 1: 
                return  this.currentProduct.product_image2;
                case 2: 
                return  this.currentProduct.product_image3;
            }
        },
        // nextImg(){
        //     this.currentImageIndex = this.currentImageIndex + 1;
        //     this.nextImage = this.currentImageIndex.product_image1;
        //     return this.nextImage;
        // },
    },
    methods:{
        next(){
            this.currentIndex = this.nextIndex;
            this.currentImageIndex = 0;
        },
        pre(){
            this.currentIndex = this.preIndex;
            this.currentImageIndex = 0;
        },
        addToCart(){
 
            if(localStorage.getItem('productList')){
                parsed = [];
                parsed.push(localStorage.getItem('productList'));

            }else{
                parsed = [];
            }
            parsed.push(JSON.stringify(this.currentProduct));
            localStorage.setItem('productList',parsed);
            console.log(JSON.parse(`[${parsed}]`));
        },
        productCountDecrease(){
            if(this.productCount>1){
                this.productCount -= 1;
            }
        },
        productCountPlus(){
            if(this.productCount<99){
                this.productCount += 1;
            }
        }
    },
});


//.heart chage img src
$(document).ready(function(){
    $(".changeIcon").click(function(){
        if($(".heart").attr('src') === "./images/icons/icon_heart.svg"){
            $(".heart").attr("src","./images/icons/icon_heart_h&c.svg");
        }else{
            $(".heart").attr("src","./images/icons/icon_heart.svg");
        }
    });

    //show .add_count
    $(".add_chart").click(function(){
        $(".add_count").css("display", "block");
    }); 

    //dot .pic change bgcolor
    $(".pic").click(function(){
        $(this).addClass("pick");
        $(this).siblings().removeClass("pick");
    });

    //reset dot .pic bgcolor
    $(".reset_dot").click(function(){
        $(".pic").removeClass("pick");
    });

    //pick size
    $(".size").click(function() {
        $(this).addClass("picked_size");
        $(this).siblings().removeClass("picked_size");
    });

    //copy discount_num

        $(".copy_num").click(function() {
          var name = $(this).attr('name');
          var el = document.getElementById(name);
          var range = document.createRange();
          range.selectNodeContents(el);
          var sel = window.getSelection();
          sel.removeAllRanges();
          sel.addRange(range);
          document.execCommand('copy');
          alert("已複製優惠券代碼");
          return false;
        });
});
