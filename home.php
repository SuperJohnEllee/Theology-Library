<?php 
    include ('connection.php'); 
    include ('session.php');
    $book_sql = "SELECT BookID  FROM theo_books";
    $books_result = mysqli_query($conn, $book_sql);
    $books_count = mysqli_num_rows($books_result);
?>

<!DOCTYPE html>
<html>
<head>
	<title> College of Theology Library </title>
	<meta name="viewport" charset="utf-8">
  <meta name="description" content="width=device-width, initial-scale=1.1">
  <meta name="author" content="College of Theology">
  <link rel="icon" href="img/logo/COT Logo.jpg">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>body{padding-top: 54px;}@media(min-width: 992px){body{padding-top: 56px; }}</style>
</head>
<body oncontextmenu="return false" class="cyan lighten-5" onload="startTime()">

<!-- Navbar here -->
<?php include ('library/html/navbar.php'); ?>

<br>
<h6 class="pull-right" id="date_time"></h6>
  <div class="container">
  <h1>Welcome, <?php echo htmlspecialchars($session_user); ?></h1>
  <div class="row">
        <div class="col-sm-12 col-sm-offset-3">
            <div id="imaginary_container"> 
                <!-- Search form -->
              <form action="home.php" method="post" class="form-inline md-form form-sm">
                  <input class="form-control form-control-sm ml-3 w-75" id="search_box" type="text" name="book_search">
                  <button type="submit" name="btn_search" class="btn btn-primary"><span class="fa fa-search"></span> SEARCH</button>
                  <label for="search">Search</label>
              </form>
            </div>
        </div>
  </div>                         
    <h1 class="my-4 text-center">Theological Books(<?php echo $books_count;?>)</h1>

    <div class="row text-center text-lg-left" id="search_area">
      <?php
        if (isset($_POST['btn_search'])) {

          $search = mysqli_real_escape_string($conn, $_POST['book_search']);
        
          $search_sql = "SELECT * FROM theo_books 
          WHERE BookName LIKE '%$search%'";
          $search_res = mysqli_query($conn, $search_sql);
          $search_count = mysqli_num_rows($search_res);

        if ($search_count > 0) {
          while ($search_row = mysqli_fetch_assoc($search_res)) {
                  $search_id = htmlspecialchars($search_row['BookID']);
                  $search_image = 'book_image/'. htmlspecialchars($search_row['BookImage']);
                  $search_name = htmlspecialchars($search_row['BookName']);
          ?>
          <div class="col-lg-3 col-md-4 col-xs-6">
          <a class="d-block mb-3 h-100" href="book-info.php?id=<?php echo htmlspecialchars($search_id); ?>">
            <img class="img-fluid img-thumbnail" src="<?php echo htmlspecialchars($search_image); ?>" alt="image">
              <h5 class="text-center"><?php echo htmlspecialchars($search_name); ?></h5>
            </a>
            </div>
        <?php
            } 
                echo "<h3 class='alert alert-success text-center'>".$search_count." results found</h3>"; 
          } else {
              echo "<h3 class='alert alert-danger text-center'><span class='fa fa-close'></span> Keyword '$search' not found</h3>"; 
        }
    } 
    
    else  {
          $book_sql = "SELECT * FROM theo_books ORDER BY BookPostDate DESC";
          $result = mysqli_query($conn, $book_sql);
              while ($row = mysqli_fetch_assoc($result)) {
                    $id = htmlspecialchars($row['BookID']);
                    $name = htmlspecialchars($row['BookName']);
                    $image = 'book_image/'.htmlspecialchars($row['BookImage']);
        ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
        <a href="book-info.php?id=<?php echo htmlspecialchars($id); ?>" class="d-block mb-3 h-100">
          <img class="img-fluid img-thumbnail" src="<?php echo htmlspecialchars($image); ?>" alt="image">
          <h5 class="text-center"><?php echo htmlspecialchars($name); ?></h5>
        </a>
      </div>
      <?php }
      } ?>
  </div>
</div>
 <div style="padding: 15px 0;" class="mdb-color darken-4 text-white text-center">
  <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
 </div>
<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="js/mdb.min.js"></script>
</body>
</html>
<script>

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

/*Night Mode*/
$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});
new WOW.init();
$('.dropdown-toggle').dropdown();
</script>