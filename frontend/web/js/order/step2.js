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
            if ($(element).is(":checked")) {
                servicePrice += parseInt($(element).data("price"));
                services.push($(element).val());
                //services += $(element).val()+", ";
            }
        });

        if ($airportTransfer.val() != "")
            servicePrice += parseInt($airportTransfer.find(":selected").text().split("-")[2].trim().split(" ")[0]);

        $("#servicePrice").text(servicePrice);
        $("#totalPrice").text(roomPrice + servicePrice);
        console.log(services);
        $("#orderstep2-room_services").val(services.join());
    }

});

