<?php
  session_start();
  include ('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
  <meta name="author" content="College of Theology">
  <meta name="twitter:card" value="summary">
  <title>College of Theology Library</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
  <link rel="stylesheet" href="css/mdb.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="icon" href="img/logo/COT Logo.jpg">
  <style>.cpu{font-size: 20px;}.links{font-size: 20px;text-decoration: none;}
</style>
</head>
<body oncontextmenu="return false" id="body" class="cyan lighten-5 index" role="document" onload="startTime()">
<!-- Navbar here -->
<?php include ('library/html/navbar.php'); ?> 
  <!--<h6 class="pull-right" id="date_time"></h6>-->
<div class="jumbotron-container cyan lighten-4" id="top-section">
  <div class="jumbotron jumbotron-fluid cyan lighten-5">
    <div class="jumbotext cyan lighten-2">
      <h2 class="jumbotext-sub text-dark">"Called & Committed to Faith, Witness & Service"</h2>
      <p class="jumbotext-main text-dark display-3">Central Philippine University<br>College of Theology</p>
      <!--<h4 class="jumbotext-sub text-dark">A Web-based Theological Library</h4>-->
    </div>
  </div>
</div>

<!--Parallax-->
    <div class="view jarallax intro-2" data-jarallax='{"speed": 0.2}' style="background-image: url(https://redeeminggod.com/wp-content/uploads/2011/06/types-of-theology1.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    </div>
<!--Carousel here -->
<?php include ('library/html/carousel.php'); ?>

<!--Journal and Book Section here -->
<?php include ('library/html/journal_book_section.php'); ?>

<!-- Mission, Vision and Philosophy & Goals-->
<?php include ('library/html/mission_vision.php'); ?>
 <div class="view jarallax intro-2" data-jarallax='{"speed": 0.2}' style="background-image: url(http://brandonchase.net/wp-content/uploads/2014/01/Theology.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    </div>

<div class="banner-1">
      <div class="container">
        <span class="banner-text">"God helps those who help themselves"</span>
      </div>
</div>
<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
    <a href="#top-section" class="btn-floating btn-large cyan darken-1">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>

<!-- Promotiom here -->
<?php include ('library/html/promotion.php'); ?>

<!-- Footer here -->
<?php include('library/html/footer.php'); ?>

<!-- My footer -->
<div style="padding: 15px 0;" class="mdb-color darken-4 text-center text-white">
        <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
    </div>

<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/mdb.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

<script>

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


//Night Mode
$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});

//Prevent right-click and F12
$(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});

//Carousel
$('.carousel').carousel();

//Scroll to Top
$(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});
</script>
</body>
</html>