window.addEventListener("load", function () {

    document.getElementById("guide_image").onchange = function (e) {
        let file = e.target.files[0];
        let reader = new FileReader();

        reader.onload = function () {
            document.getElementById("imgPreciew").src = reader.result;
            // console.log(reader.result);
        }

        reader.readAsDataURL(file);
    }

    document.getElementById("mem_idno_image").onchange = function (e) {
        let file = e.target.files[0];
        let reader = new FileReader();

        reader.onload = function () {
            document.getElementById("imgPreciew").src = reader.result;
            // console.log(reader.result);
        }

        reader.readAsDataURL(file);
    }

})