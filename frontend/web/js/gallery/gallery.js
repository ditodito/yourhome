$(document).ready(function() {

    $(".img-item").on("click", function() {
        var $item = $(this);
        $(".img-item").removeClass("img-item-active");
        $item.addClass("img-item-active");

        $(".img-main").prop("src", $item.prop("src"));
    });

});