function initMap() {
    var coord = {lat: 41.712990, lng:  44.798526};

    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: coord
    });

    var marker = new google.maps.Marker({
        position: coord,
        map: map
    });
}