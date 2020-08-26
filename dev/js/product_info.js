new Vue({
    el: '#app',
    data: {
        products:[{}],
        currentIndex: 0 ,
        currentImageIndex: 0,
        addCount: 0,
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
    },
});

//.heart chage img src
$(document).ready(function(){
    $(".changeIcon").click(function(){
        if($(".heart").attr('src') != "./images/icons/md-heart.png"){
            $(".heart").attr("src","./images/icons/md-heart.png");
        }else{
            $(".heart").attr("src","./images/icons/feather-heart.png");
        }
    });
    $(".add_chart").click(function(){
        $(".add_count").css("display", "block");
    }); 
});

//dot .pic change bgcolor
document.ready(function(){
    $(".pic").click(function(){
        $(this).addClass("pick");
        // $(this).siblings().removeClass("pick");
    });
});