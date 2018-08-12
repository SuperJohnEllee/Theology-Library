//Date and Time
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('date_time').innerHTML = today;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

// Regular map
function theo_map() {  
    var theo_location = new google.maps.LatLng(10.729977,122.549298);

    var theo_map_options = {
        center: theo_location,
        zoom: 15,
    };

    var theo_map = new google.maps.Map(document.getElementById("theo_map"),
        theo_map_options);

    var theo_marker = new google.maps.Marker({
        position: theo_location,
        map: theo_map,
        title: "Central Philippine University College of Theology",
        animation: google.maps.Animation.DROP,
    });
    theo_marker.setMap(theo_map);
}
// Initialize maps
google.maps.event.addDomListener(window, 'load', theo_map);

/*Night Mode*/
$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});