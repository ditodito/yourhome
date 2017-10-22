$(document).ready(function() {

    $("#changeDate").on("click", function() {
        $("#changeDateModal").modal();
    });

    $(".room-quantity").on("change", function() {
        var totalPrice = 0;

        $(".room-quantity").each(function(i, element) {
            var id = $(element).data("id");
            var price = $(element).find("option:selected").data("price");
            totalPrice += $(element).val() * price * totalDays;
        });

        $("#price").text(totalPrice);
        $("#submitBtn").prop("disabled", (totalPrice == 0) ? true : false);
    });

});