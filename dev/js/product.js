new Vue ({
    el: '#wrap',
    data: {
        products: [],
        currentCategory: '登山鞋',
    },
    mounted(){
        axios.get('./json/Initial_product.json')

            .then((res) => {
              this.products = res.data;
              console.log(res.data);
            })
    },
    computed:{
        groupByCategory(){
            let result = {};
            for(let product of this.products){
                const category = product.category
                if(result[category] !== undefined){
                    result[category].push(product);
                }else{
                    result[category] = [];
                    result[category].push(product);
                }
            }

            console.log(result)
            return result;
        },
        currentProducts(){
            return this.groupByCategory[this.currentCategory]
        },
        currentCategoryImg(){
            switch(this.currentCategory){
            case '機能服飾': 
                return './images/products/clothes/clothes01.png';
            case '登山背包': 
                return './images/products/bag/bag0.png';
            case '登山鞋': 
                return './images/products/shoes/shoes0.png';
            case '露營裝備': 
                return './images/products/campGear/tent0.png';
            case '登山配件':
                return './images/products/others/poles0.png';
            }
        },
    },
    methods:{
        changeCurrentCategory(category){
            this.currentCategory = category;
        },
        backgroundColor(index){
            switch(index){
                case 0: 
                    return 'it_bg1';
                case 1: 
                    return 'it_bg2';
                case 2: 
                    return 'it_bg3';
                case 3: 
                    return 'it_bg4';
                default:
                    return 'it_bg1';
            }
        },
    },
});


// function groupByCategory(products){
//     let result = {};
//     for(let product of products){
//         const category = product.category
//         if(result[category] !== undefined){
//             result[category].push(product);
//         }else{
//             result[category] = [];
//             result[category].push(product);
//         }
//     }
//     return result;
// }

// let products = [
//     {
//         id: 1,
//         category: 'shoes',
//     },
//     {
//         id: 2,
//         category: 'bag',
//     },
//     {
//         id: 3,
//         category: 'clothes',
//     },
//     {
//         id: 4,
//         category: 'campGear',
//     },
//     {
//         id: 5,
//         category: 'others',
//     },
//     {
//         id: 6,
//         category: 'shoes',
//     },
//     {
//         id: 7,
//         category: 'bag',
//     },
//     {
//         id: 8,
//         category: 'clothes',
//     },
// ]

// console.log(groupByCategory(products));



// $(document).ready(function(){
//     var time = 0;
//     function autoPlay(){
//         $('.category_list').click(function(){
//         　　time = setInterval(function(){
//                 $('.product_name').css('transform', 'translateX(0)');
//                 $('.product_price').css('transform', 'translateX(0)');
//             },1000)
//         $('.product_name').css('transform', 'translateX(100%)');
//         $('.product_price').css('transform', 'translateX(100%)');
//         });
//     }
//     autoPlay();
// });
