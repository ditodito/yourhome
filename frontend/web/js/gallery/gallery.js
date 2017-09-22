$(document).ready(function() {

    $(".prev, .next").on("click", function() {
        var $nav = $(this);
        var $next;
        var $item;

        if ($nav.hasClass("prev")) {
            $next = $(".img-item-active").prev(".img-item");
            $item = ($next.length > 0) ? $next : $(".img-item").last();
        } else {
            $next = $(".img-item-active").next(".img-item");
            $item = ($next.length > 0) ? $next : $(".img-item").first();
        }

        $item.click();
    });

    $(".img-item").on("click", function() {
        var $item = $(this);
        var image = $item.data("image");
        var alt = $item.prop("alt");

        $(".img-item").removeClass("img-item-active");
        $item.addClass("img-item-active");

        $(".img-main").prop({src: phpData.webDir+"/img/gallery/"+image, alt: alt});
    });

});