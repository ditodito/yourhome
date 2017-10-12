$(document).ready(function() {

    $("#changeDate").on("click", function() {
        $("#changeDateModal").modal();
    });

    $(".room-quantity").on("change", function() {
        var totalPrice = 0;

        $(".room-quantity").each(function(i, element) {
            var price = $(element).find("option:selected").data("price");
            totalPrice += $(element).val() * price;
        });

        $("#price").find("span").text(totalPrice);
    });

});