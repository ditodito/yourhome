var $changeDate = null;
var $rooms = null;
var $changeDateModal = null;

$(document).ready(function() {
    $changeDate = $("#changeDate");
    $rooms = $(".rooms");
    $changeDateModal = $("#changeDateModal");

    if (showForm == 1)
        $changeDateModal.modal();

    $changeDate.on("click", function() {
        $changeDateModal.modal();
    });

    $rooms.on("change", function() {
        var totalPrice = 0;

        $rooms.each(function(i, element) {
            var price = $(element).find("option:selected").data("price");
            totalPrice += price * totalDays;
        });

        $("#price").text(totalPrice);
        $("#submitBtn").prop("disabled", (totalPrice == 0));
    });
});