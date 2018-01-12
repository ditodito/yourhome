var $changeDate = null;
var $changeDateModal = null;

$(document).ready(function() {
    $changeDate = $(".change-date");
    $changeDateModal = $("#changeDateModal");

    $changeDate.on("click", function() {
        $changeDateModal.modal();
    });
});