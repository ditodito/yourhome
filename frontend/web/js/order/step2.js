$(document).ready(function() {

    $("#orderstep2-airport_transfer_price_id").on("change", function() {
        updatePrices()
    });

    function updatePrices() {
        var roomPrice = parseInt($("#roomPrice").text());
        var servicePrice = 0;
        var $airportTransfer = $("#orderstep2-airport_transfer_price_id");

        if ($airportTransfer.val() != "")
            servicePrice += parseInt($airportTransfer.find(":selected").text().split("-")[2].trim().split(" ")[0]);

        $("#servicePrice").text(servicePrice);
        $("#totalPrice").text(roomPrice + servicePrice);
    }

});

