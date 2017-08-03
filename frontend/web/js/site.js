$(document).ready(function() {

    $("#languages").on("change", function() {
        window.location.href = $(this).find("option:selected").data("url");
        //console.log($(this).find("option:selected").data("url"));
    });

});