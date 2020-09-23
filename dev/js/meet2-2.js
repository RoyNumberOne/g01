 
///公版圖片 難度 地區
new Vue({
    el: "#tour_build_form", //html的位置
    data: {
        mtList: [],
        mtIndex: [],  //
    },

    created(){
        
        // console.log($("#tour_mountain").value)

        // $.post("./phpForConnect/meet2-2Mountainlist.php",
        // {MTno: '1'},
        // function(){
        //     console.log('ya');
        // })

        axios.get('./phpForConnect/meet2-2MountainlistF.php')

        .then((res) => {
            this.mtList = res.data;
            console.log(res.data); //測試是否成功
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
            
        },
        /////切換步驟///// -->
        ONEtoTWO: function(){
            console.log("click");
            let valid = 0 ; //計算未填數量  = 0 都填  != 0 有未填
            var tour_info1 = document.querySelectorAll('.tour_info1 [required]'); 

            console.log(tour_info1.length);

            for(let i=0 ; i<tour_info1.length ; i++){
                if(tour_info1[i].checkValidity() != true){ //判斷每個 必填的[required] input 是否都有填
                    valid += 1 ; //有未填的時候valid+1 
                }
            }

            if(valid == 0){ // 都填
                // 判斷日期是否符合規定
                var today=new Date(); //今天

                var strdate = new Date(document.querySelector('[name="tour_activitystart"]').value);//開團出發的日期

                Date.prototype.addDays = function(days) {
                    this.setDate(this.getDate() + days);
                    return this;
                }

                var after7d = today.addDays(7); // 一週後
                
                if (strdate <= after7d){
                    // alert('開團日期需為一週後~');
                    swal("開團日期需為一週後~！")
                }else{
                    //判斷回程日期是否大於出發日期

                    var enddate = new Date(document.querySelector('[name="tour_activityend"]').value);//開團回程的日期
                    

                    if ( enddate < strdate){
                        swal("出發日期不可以比回程晚呀！！")

                    }else{
                           //移除 -on 樣式
                        $("section.tour_build_step1").removeClass("-on");
                        $("li.step_icon1").removeClass("-on");
    
                            // 加上 -on 樣式
                        $("section.tour_build_step2").addClass("-on");
                        $("li.step_icon2").addClass("-on");
                    }
                }

                 

            }else{ //有未填的時候
                document.querySelector('[name="tour_activityend"]').reportValidity();
                document.querySelector('[name="tour_activitystart"]').reportValidity();
                document.querySelector('[name="tour_title"]').reportValidity();
            };

                
        },

        TWOtoONE: function(){
            console.log("click");

                //移除 -on 樣式
            $("section.tour_build_step2").removeClass("-on");
            $("li.step_icon2").removeClass("-on");

                // 加上 -on 樣式
            $("section.tour_build_step1").addClass("-on");
            $("li.step_icon1").addClass("-on");
        
        },

        TWOtoTHREE: function(){
            console.log("click");

            var tour_info2 = document.querySelector('.tour_info2 [required]').checkValidity(); 

            console.log(tour_info2);


            if(tour_info2){ // 都填
                        //移除 -on 樣式
                $("section.tour_build_step2").removeClass("-on");
                $("li.step_icon2").removeClass("-on");

                    // 加上 -on 樣式
                $("section.tour_build_step3").addClass("-on");
                $("li.step_icon3").addClass("-on");
            }else{ //有未填的時候
                document.querySelector('[name="tour_innertext"]').reportValidity();
            };
        },

        THREEtoTWO: function(){
            console.log("click");
            //移除 -on 樣式
            $("section.tour_build_step3").removeClass("-on");
            $("li.step_icon3").removeClass("-on");
    
                // 加上 -on 樣式
            $("section.tour_build_step2").addClass("-on");
            $("li.step_icon2").addClass("-on");
        },
        THREEtoSEND: function(){
            $("#tour_build_form").submit();
        }
    },
});


/////圖片上傳預覽///// -->

$("#upload_tourimg_input").change(function(){
    // var docObj = document.getElementById("upload_tourimg_input");
    // var fileList = docObj.files;
    $(".tour_image div").html(""); // 清除預覽
    console.log ( this.files.length );
    if(this.files.length > 6) {
        swal("太貪心拉～照片最多只能上傳六張！！")

        
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

            }
            reader.readAsDataURL(input.files[i]);
        }
    }else{
        var noPictures = $("<p>目前尚未上傳圖片</p>");
        $(".tour_image").append(noPictures);
    }
}
