       new Vue({
            el: '#app',
            data: {
                products:[{}],
                currentIndex: 0 ,
            },
            mounted(){
                // axios.get('../json/Initial_product.json').then(res => this.products = res.data);
                axios.get('./json/Initial_product.json')

                    .then((res) => {
                      this.products = res.data;
                      console.log(res.data);
                    })
              
                    // .then(res => this.products = res.data)
                    // .then(res => {console.log(res.data)})
                    // .catch(error => {console.log(error)});
                

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
            },
            methods:{
                next(){
                    this.currentIndex = this.nextIndex;
                },
                pre(){
                    this.currentIndex = this.preIndex;
                },
            },
        });