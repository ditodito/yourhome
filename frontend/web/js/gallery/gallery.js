$(document).ready(function() {

    $(".img-item").on("click", function() {
        var $item = $(this);
        var image = $item.data("image");

        $(".img-item").removeClass("img-item-active");
        $item.addClass("img-item-active");

        $(".img-main").prop("src", phpData.webDir+"/img/gallery/"+image);
    });

});