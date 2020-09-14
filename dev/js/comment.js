new Vue({
    el: "#comment",
    data: {
        dialog:[],
        reflection:[],
    },
    created(){
        //文章發布
        axios.get('./phpForConnect/commentPostReflection.php').then(res => {
            this.reflection = res.data;
            console.log('success');
            console.log(this.reflection);
        }),

        // 留言回覆區
        axios.get('./phpForConnect/commentPostDialog.php').then(res => {
            this.dialog = res.data;
            console.log('success');
            console.log(this.dialog);
        })
    },
});

//.heart chage img src
$(document).ready(function(){
    $(".commentCollect").click(function(){
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
});