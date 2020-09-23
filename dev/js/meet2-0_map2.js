
let map;
let secretMessages = [];

let mtLists = [];
let meetList = [];
let markers = [];

function initMap() {

    

    // 設定地圖中心點 比例尺  (設定 Marker（多個）)
    const map = new google.maps.Map(document.getElementById("searchMap"), {
        zoom: 7,
        center: { lat: 23.469806, lng: 120.957617 }, // "玉山"
    });

//--- SET  MARKERS --------------------------------------------------------------------------
    // 設定換的圖
    const image = {
        url:"./images/icons/icon_map_mark.svg",
    };

    axios.get(`./phpForConnect/2-0meetMapGetmountain.php`) //根據哪個php
            .then((res) => {
                mtList = res.data;

                for( i=0 ; i<mtList.length ; i++ ) {
                    let mt =`${mtList[i].mountain_name}`;

                    let marker = new google.maps.Marker({
                        position: { lat: parseFloat(mtList[i].mountain_latitude), lng: parseFloat(mtList[i].mountain_longitude) }, 
                        map: map,
                        icon: image, //換圖
                        title: mtList[i].mountain_name , //滑鼠滑過後文字 
                        animation: google.maps.Animation.DROP //動畫 掉落(drop)
                        
                    });

                    markers.push(marker);

                    mtLists.push(mtList[i]); //將mtList資料放入mtLists 使其資料皆可被使用 每座山的資料

                }
                
            })
            .catch(error => { console.log(error) });

//--- SET   secretMessages --------------------------------------------------------------------------

    setTimeout(function(){

        console.log(markers);

        let k ;
        for( k=0 ; k < mtList.length ; k++ ){

            axios.get(`./phpForConnect/2-0meetMapMtTourList.php?mtName=${mtLists[k].mountain_name}`) //根據哪個php
                .then((res) => {
                    meetList = res.data;

                    let str1 = `<section class="marker_click_info">
                        <div class="mountain_name">
                            <h3 class="text_underline">${meetList[0].mountain_name}<span>難度${meetList[0].degree_category}</span></h3>
                        </div> <div class="meets">`;

                    let str2 = '';

                    for( j=0 ; j < meetList.length ; j++ ) {
                        str2 +=
                            `<a onclick="location.href='./meet2-3.html?tour_no=${meetList[j].tour_no}'">
                                 
                                    <p>${meetList[j].tour_title}</p>
                                        <div class="date_member">
                                        <span class="date">${meetList[j].tour_activitystart}</span><span>出發</span>
                                        <div class="member_styleC">
                                            <div class="memberImg">
                                                <img src="${meetList[j].mem_avator}" alt="">
                                            </div>
                                            <div class="memberId">${meetList[j].mem_id}</div>
                                        </div>
                                    </div>
                               
                            </a>`;
                    }

                    let str3 = `</div>
                    </section>`;
                    
                    FINALstr = str1+str2+str3;

                    secretMessages.push(
                        FINALstr
                    );
                })
                .catch(error => { console.log(error) });
        }
    },500);
//--- attach SecretMessage --------------------------------------------------------------------------

    setTimeout(function(){
        attachSecretMessage(markers[0], secretMessages[0].toString());
        for( i=0 ; i<markers.length ; i++ ){
            attachSecretMessage(markers[i], secretMessages[i].toString());

        }

      },1500);
// 
//-----------------------------------------------------------------------------

}  //function initMap()結束

// Marker click info (多個 方法 1 ) 
function attachSecretMessage(marker, secretMessage) {
    const infowindow = new google.maps.InfoWindow({
        content: secretMessage
    });
    marker.addListener("click", () => {
        
        // infowindow.open(marker.get("map"), marker);

        // // infowindow.open(this.marker.get("map"), this.marker);

        // setTimeout(function(){
        //     infowindow.close(marker);
        // },1000);

        infowindow.close(markers);

        setTimeout(function(){
            infowindow.open(marker.get("map"), marker);
        },300);


    });
}


