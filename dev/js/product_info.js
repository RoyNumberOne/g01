new Vue({
    el: '#app',
    data: {
        products: [{}],
        currentIndex: 0,
        currentImageIndex: 0,
        productCount: 1,
        cartList: [{}],
        productNo: null,
    },
    mounted() {
        axios.get('./phpForConnect/product_info.php').then(res => {
            this.products = res.data;

            let urlSearchParams = (new URL(document.location)).searchParams;
            this.productNo = urlSearchParams.get('productNo');

            this.checkAndInitCart();
            this.showCart();
            // console.log(this.products.length)

            this.currentIndex = this.findProductIndex(this.productNo);



        })
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
            if (this.currentIndex === this.productsCount - 1) { // current product is the last product
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
        currentImage() {
            switch (this.currentImageIndex) {
                case 0:
                    return this.currentProduct.product_image1;
                case 1:
                    return this.currentProduct.product_image2;
                case 2:
                    return this.currentProduct.product_image3;
            }
        },
        cartCount() {
            return Object.keys(this.cartList).length;
        },
        pickedProductInfo() {
            let pickedProductInfo = {
                product_no: this.currentProduct.product_no,
                product_name: this.currentProduct.product_name,
                product_price: this.currentProduct.product_price,
                product_image1: this.currentProduct.product_image1,
                product_category: this.currentProduct.product_category
            }
            return pickedProductInfo;
        },
    },
    updated() {
        //判斷收藏
        let product_no = this.currentProduct.product_no;
        var xhr = new XMLHttpRequest();
        xhr.onload = function(e) {
            if (xhr.status == 200) { //連線成功
                console.log(xhr.responseText)
                if (xhr.responseText != 0) {
                    $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                } else {
                    $(".heart").attr("src", "./images/icons/icon_heart.svg");
                }
            } else {
                swal(xhr.status);
            }

        }
        var url = "./phpForConnect/product_Collect_pic.php";
        xhr.open("post", url, true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
        let data = `product_no=${product_no}`;
        xhr.send(data);
    },
    methods: {
        next() {
            this.currentIndex = this.nextIndex;
            this.currentImageIndex = 0;
            this.productCount = 1;
            $('.dot :first-child').addClass('pick');
            const newUrl = 'http://localhost:8888/g01/dev/product_info.html?productNo=' + this.currentProduct.product_no;
            history.pushState('', '', newUrl);
        },
        pre() {
            this.currentIndex = this.preIndex;
            this.currentImageIndex = 0;
            this.productCount = 1;
            const newUrl = 'http://localhost:8888/g01/dev/product_info.html?productNo=' + this.currentProduct.product_no;
            history.pushState('', '', newUrl);
            $('.dot :first-child').addClass('pick');
        },

        checkAndInitCart() {
            if (localStorage.getItem('cartList') === null) {
                let cart = JSON.stringify({})
                localStorage.setItem('cartList', cart)
                this.cartList = {}
            } else {
                let cartList = JSON.parse(localStorage.getItem('cartList'))
                this.cartList = cartList
            }
        },

        addToCart() {
            if (this.cartList[this.currentProduct.product_no] === undefined) {
                let cartItem = {}
                cartItem[this.currentProduct.product_no] = { product: this.pickedProductInfo, count: this.productCount }
                    // this.cartList = { ...this.cartList, ...cartItem }  es6 //把剛才創的cartItem放進cartList裡面
                this.cartList = Object.assign({}, this.cartList, cartItem)
                this.upDateLocalStorage();
            } else {
                this.cartList[this.currentProduct.product_no].count += this.productCount;
                console.log(this.cartList);
                this.upDateLocalStorage();
            }
        },

        upDateLocalStorage() {
            localStorage.setItem('cartList', this.cartListJsonString());
        },

        cartListJsonString() {
            return JSON.stringify(this.cartList);
        },

        productCountDecrease() {
            if (this.productCount > 1) {
                this.productCount -= 1;
            }
        },
        productCountPlus() {
            if (this.productCount < 99) {
                this.productCount += 1;
            }
        },
        showCart() {
            if (Object.keys(this.cartList).length > 0) {
                $(".add_count_vue").css("display", "block");
            }
        },
        findProductIndex(productNo) {
            for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].product_no === productNo) {
                    return i;
                } else {
                    console.log('not find')
                }
            }
        },
        product_Collect() {

            let product_no = this.currentProduct.product_no;
            let xhr2 = new XMLHttpRequest();

            xhr2.onload = function() {
                member = JSON.parse(xhr2.responseText);
                if (member.mem_id) {
                    //已經登入了，可以開始做事了
                    var xhr = new XMLHttpRequest();
                    xhr.onload = function(e) {
                        if (xhr.status == 200) { //連線成功
                            console.log(xhr.responseText);
                            // swal(xhr.responseText);
                        } else {
                            swal(xhr.status);
                        }
                    }
                    var url = "./phpForConnect/product_Collect.php";
                    xhr.open("post", url, true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
                    let data = `product_no=${product_no}`;
                    xhr.send(data);

                    if ($(".heart").attr('src') === "./images/icons/icon_heart.svg") {
                        $(".heart").attr("src", "./images/icons/icon_heart_h&c.svg");
                    } else {
                        $(".heart").attr("src", "./images/icons/icon_heart.svg");
                    }
                } else {
                    //沒有登入，請先登入
                    swal("請先登入哦")
                }
            }

            xhr2.open("get", "./login_v2_LoginInFo.php", true);
            xhr2.send(null);



        },
    },
});


//.heart chage img src
$(document).ready(function() {

    //show .add_count_vue
    $(".add_chart").click(function() {
        $(".add_count_vue").css("display", "block");
    });

    //dot .pic change bgcolor
    $(".pic").click(function() {
        $(this).addClass("pick");
        $(this).siblings().removeClass("pick");
    });

    //reset dot .pic bgcolor
    $(".reset_dot").click(function() {
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
          swal("已複製優惠券代碼");
        return false;
    });

    //assign url by productNo
    // let url = new URL(window.location.href);
    // console.log(url);
    // let productNo = new URLSearchParams(url.search);
    // productNo = productNo.get("productNo");
    // console.log(productNo);
    // var formProduct = new FormData;
    // formProduct.append('productNo' ,productNo);
});