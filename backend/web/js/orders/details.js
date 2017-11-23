var $selectedRooms = null;
var $submitBtn = null;

$(document).ready(function() {
    $selectedRooms = $("#ordersmodel-rooms");
    $submitBtn = $("#submitBtn");

    if ($selectedRooms.val()) {
        var $rooms = $selectedRooms.val().split(",");

        $.each($rooms, function(i, room) {
            var roomId = room.split("-")[0];
            $("#rooms" + roomId).val(room);
        });

        $submitBtn.prop("disabled", false);
    }

    $(".rooms").on("change", function() {
        var rooms = [];

        $(".rooms").each(function(i, element) {
            var value = $(element).val();
            if (value)
                rooms.push(value);
        });

        $selectedRooms.val(rooms.join());
        $submitBtn.prop("disabled", (rooms.length <= 0));
    });
});

