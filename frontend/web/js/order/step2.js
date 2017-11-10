$(document).ready(function() {

    $(".room-service").on("click", function() {
        updatePrices();
    });

    $("#orderstep2-airport_transfer_price_id").on("change", function() {
        updatePrices()
    });

    function updatePrices() {
        var roomPrice = parseInt($("#roomPrice").text());
        var servicePrice = 0;
        var $airportTransfer = $("#orderstep2-airport_transfer_price_id");
        var services = [];

        $(".room-service").each(function(i, element) {
            var price = $(element).data("price");
            var perNight = $(element).data("per-night");

            if ($(element).is(":checked")) {
                servicePrice += (perNight == 1) ? price * totalDays : price;
                services.push($(element).val());
            }
        });

        if ($airportTransfer.val() != "")
            servicePrice += parseInt($airportTransfer.find(":selected").text().split("-")[2].trim().split(" ")[0]);

        $("#servicePrice").text(servicePrice);
        $("#totalPrice").text(roomPrice + servicePrice);
        $("#orderstep2-room_services").val(services.join());
    }

});

