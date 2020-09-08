new Vue({
    el: '#app',
    data: {
        products:[{}],
        currentIndex: 0 ,
        currentImageIndex: 0,
        productCount: 1,
        cartList: {},
    },
    // created(){
        // axios.get('./phpForConnect/product_info.php').then(res => {
        //     this.products = res.data;
        //     console.log('success');
        //     console.log(this.products);
        // })
        // axios.get('./phpForConnect/product_info_related_artical.php').then(res => {
        //     this.products = res.data;
        //     console.log('success');
        //     console.log(this.products);
        // })
    // },
    mounted(){
        axios.get('./phpForConnect/product_info.php').then(res => {
            this.products = res.data;
            console.log('success');
            console.log(this.products);
        })
        this.checkAndInitCart();
        this.showCart();

        
        // if(localStorage.getItem('cartList')){
        //     try{
        //         this.cart = JSON.parse(`[${localStorage.getItem('cartList')}]`);
        //         console.log(JSON.parse(`[${this.cartList}]`));
        //     }catch(e){
        //         localStorage.removeItem('cartList');
        //     }
        // };
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
        cartCount(){
            return Object.keys(this.cartList).length;
        },
    },
    methods:{
        next(){
            this.currentIndex = this.nextIndex;
            this.currentImageIndex = 0;
            this.productCount = 1;
            $('.dot :first-child').addClass('pick');
        },
        pre(){
            this.currentIndex = this.preIndex;
            this.currentImageIndex = 0;
            this.productCount = 1;
            $('.dot :first-child').addClass('pick');
        },
        // addToCart(){
 
        //     if(localStorage.getItem('cartList')){
        //         parsed = [];
        //         parsed.push(localStorage.getItem('cartList'));

        //     }else{
        //         parsed = [];
        //     }
        //     parsed.push(JSON.stringify(this.currentProduct));
        //     localStorage.setItem('cartList',parsed);
        //     console.log(JSON.parse(`[${parsed}]`));
        // },

        checkAndInitCart(){
            if(localStorage.getItem('cartList') === null){
                let cart = JSON.stringify({})
                localStorage.setItem('cartList', cart)
                this.cartList = {}
            }else{
                let cartList = JSON.parse(localStorage.getItem('cartList'))
                this.cartList = cartList
            }
        },

        addToCart(){
            if(this.cartList[this.currentProduct.product_no] === undefined){
                let cartItem = {}
                cartItem[this.currentProduct.product_no] = { product: this.currentProduct, count: this.productCount}
                // this.cartList = { ...this.cartList, ...cartItem }  es6 //把剛才創的cartItem放進cartList裡面
                this.cartList = Object.assign({}, this.cartList, cartItem)
                this.upDateLocalStorage();    
            }else{
                this.cartList[this.currentProduct.product_no].count += this.productCount;
                console.log(this.cartList);
                this.upDateLocalStorage();    
            }
        },

        upDateLocalStorage(){
            localStorage.setItem('cartList',this.cartListJsonString());
        },

        cartListJsonString(){
            return JSON.stringify(this.cartList);
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
        },
        showCart(){
            if(Object.keys(this.cartList).length>0){
                $(".add_count").css("display", "block");
            }
        },
    }, 
});


//.heart chage img src
$(document).ready(function(){
    $(".productCollect").click(function(){
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
        //   alert("已複製優惠券代碼");
          return false;
        });
});
