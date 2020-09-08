new Vue({
    el: "#main_forum",
    data: {
        articalList: [],
        currentIndex: [],
    },
    mounted(){
        axios.get('./json/Initial_forum_post.json')
        
        .then((res) => {
            this.articalList = res.data;
            console.log(res.data);
            for(let i = 0; i< this.articalList.length; i++){
                this.currentIndex.push(i)
            }
        })
        // .then(res => this.articalList = res.data)
        // .then(res => {console.log(res.data)})

        .catch(error => {console.log(error)});
    },
    // methods:{

    // },
    // computed:{

    // },
})