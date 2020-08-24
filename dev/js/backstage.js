$(document).ready(function () {
    $("ul.page").click(function (event) {
        event.preventDefault();
        $("ul.page").removeClass("ulat");
        $(this).addClass("ulat");
        $(this).siblings().removeClass("ulat");
        $(this).siblings().children().removeClass("liat");
    });
    $("li.page").click(function (event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass("ulat");
        $("ul.page").removeClass("ulat");
        $("li.page").removeClass("liat");
        $(this).addClass("liat");
        $(this).parent().addClass("ulat");
    });
});