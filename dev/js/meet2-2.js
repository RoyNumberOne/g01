 
/////公版圖片 難度 地區
new Vue({
    el: "#tour_build_form", //html的位置
    data: {
        mtList: [],
        mtIndex: [],  //
    },

    mounted(){
        
        // console.log($("#tour_mountain").value)

        // $.post("./phpForConnect/meet2-2Mountainlist.php",
        // {MTno: '1'},
        // function(){
        //     console.log('ya');
        // })

        axios.get('./phpForConnect/meet2-2MountainlistF.php')

        .then((res) => {
            this.mtList = res.data;
            // console.log(res.data); //測試是否成功
        })
        .catch(error => {console.log(error)}); 
    },
    methods:{
        findMT: function(){
            let mtData 
            let MTarea
            let MTdegree
            let MTno = $("select#tour_mountain").val()
            console.log(MTno) 

            $.post("./phpForConnect/meet2-2Mountainlist.php",
            {MTno: MTno},

            function(mt){
                console.log(JSON.parse(mt));
                mtData = JSON.parse(mt);  ////將資料轉json
                console.log(mtData[0].mountain_area)
                
                switch (mtData[0].mountain_area){
                    case('north'):
                        $(".mountain_area p").text('北部');
                    break;
                    case('west'):
                        $(".mountain_area p").text('中部');
                    break;
                    case('south'):
                        $(".mountain_area p").text('南部');
                    break;
                    case('east'):
                        $(".mountain_area p").text('東部');
                    break;
                }

                console.log(mtData[0].degree_category)
                $(".degree_category p").text(mtData[0].degree_category);
                console.log(mtData[0].mountain_image)
                $(".mountain_image img").attr('src',mtData[0].mountain_image);
            })
            
            // console.log(ya);
            
            // $.ajax({
            //     url: "./phpForConnect/meet2-2Mountainlist.php",
            //     data: {
            //         MTno: MTno,
            //     },
            //     type: 'POST',
            //     success(){
            //         console.log(MTno) 
            //     },
            // })


            // var formMT = new FormData;
            // var MTNO = $("tour_mountain").val();
            // formMT.append("MTNO",MTNO)

            // axios.get('./phpForConnect/meet2-2Mountainlist.php',formMT)
    
            // .then((res) => {
            //     this.mtList = res.data;
            //     console.log(res.data); //測試是否成功
    
            //     for(let i = 0; i< this.mtList.length; i++){  //動態生成內容，依據json有幾筆
            //         this.mtIndex.push(i)
            //     }
            // })
            // .catch(error => {console.log(error)}); 
        }
    },
});

 
 
/////切換步驟///// -->

$(function() {
    // preventDefault
    $("button#step1_to_stpe2","button#step2_to_stpe1","button#step2_to_stpe3","button#step3_to_stpe2")
        .on("click", function(event){
        event.preventDefault();
        console.log("click");
    });

    //1>2
    $("button#step1_to_stpe2").on("click", function(){
        console.log("click");
        
            //移除 -on 樣式
        $("section.tour_build_step1").removeClass("-on");
        $("li.step_icon1").removeClass("-on");

            // 加上 -on 樣式
        $("section.tour_build_step2").addClass("-on");
        $("li.step_icon2").addClass("-on");
        
    });

    //2>1
    $("button#step2_to_stpe1").on("click", function(){
        console.log("click");
        
            //移除 -on 樣式
        $("section.tour_build_step2").removeClass("-on");
        $("li.step_icon2").removeClass("-on");

            // 加上 -on 樣式
        $("section.tour_build_step1").addClass("-on");
        $("li.step_icon1").addClass("-on");
        
    });

    //2>3
    $("button#step2_to_stpe3").on("click", function(){
        console.log("click");
        
            //移除 -on 樣式
        $("section.tour_build_step2").removeClass("-on");
        $("li.step_icon2").removeClass("-on");

            // 加上 -on 樣式
        $("section.tour_build_step3").addClass("-on");
        $("li.step_icon3").addClass("-on");
        
    });

    //3>2
    $("button#step3_to_stpe2").on("click", function(){
        console.log("click");
        
            //移除 -on 樣式
        $("section.tour_build_step3").removeClass("-on");
        $("li.step_icon3").removeClass("-on");

            // 加上 -on 樣式
        $("section.tour_build_step2").addClass("-on");
        $("li.step_icon2").addClass("-on");
        
    });

});



/////圖片上傳預覽///// -->

$("#upload_tourimg_input").change(function(){
    // var docObj = document.getElementById("upload_tourimg_input");
    // var fileList = docObj.files;
    $(".tour_image div").html(""); // 清除預覽
    console.log ( this.files.length );
    if(this.files.length > 6) {
        alert('最多只能上傳六張照片');
    }   else {
        readURL(this);
    }
});

function readURL(input){
    if (input.files && input.files.length >= 0) {
        for(var i = 0; i < input.files.length; i ++){
            let t;
            t = i + 1;
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img>").attr({src : e.target.result , id : "iimg" + i});
                $("div.tour_image_"+t).append(img);


                // $(".tour_image_"+i).append(img); //
                // $(".tour_image").append(img); //
                // $(".tour_image").prepend("<div id = img"+i+"></div>");
                // $(".tour_image div#img"+i).append(img);
                // $(".tour_image").prepend('</div>'); //
                // $(".tour_image").append('<div>').append(img).append('</div>');
            }
            reader.readAsDataURL(input.files[i]);
        }
    }else{
        var noPictures = $("<p>目前尚未上傳圖片</p>");
        $(".tour_image").append(noPictures);
    }
}