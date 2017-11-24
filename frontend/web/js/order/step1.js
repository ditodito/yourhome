$(document).ready(function() {

    $("#changeDate").on("click", function() {
        $("#changeDateModal").modal();
    });

    $(".rooms").on("change", function() {
        var totalPrice = 0;

        $(".rooms").each(function(i, element) {
            var price = $(element).find("option:selected").data("price");
            totalPrice += price * totalDays;
        });

        $("#price").text(totalPrice);
        $("#submitBtn").prop("disabled", (totalPrice == 0));
    });

});