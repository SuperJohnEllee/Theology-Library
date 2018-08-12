<?php
	include ('session.php');
	include ('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
  <meta name="author" content="College of Theology">
  <meta name="twitter:card" value="summary">
  <title>College of Theology Library</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.apis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#">
			<img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
		<button class="navbar-toggler cyan lighten-3" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto"> 
				<li class="nav-item">
					<a class="nav-link text-white" href="home.php"><span class="fa fa-home"></span><span class="sr-only">(current)</span> Home</a>
				</li>
			</ul>
		</div>
	</nav>
	<br>
	<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header teal lighten-3 text-center">
					<h4 class="modal-title w-100 font-weight-bold">Book Reservation</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-label="true">&times;</span>
					</button>
				</div>
					<p class="text-center">Note: You can only reserved 1 book for 2 days</p>
            	<div class="modal-body mx-3">
			    <form method="post">
                    <div class="md-form mb-5">
                    	<i class="fa fa-calendar prefix"></i>
						<input type="date" name="date_reserved" id="date_reserved" class="form-control datepicker">
						<label for="date_reserved">Date of Reservation</label>
                    </div>
                    <div class="md-form mb-4">
                        <button type="submit" class="btn btn-default" name="btn_reserved" data-loading-text="Reserving in.."><span class="fa fa-chevron-circle-right"></span> Reserved</button>
                    </div>
                </form>
            	</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="page-header"><br><br>
			<h3>Book Information</h3>
		</div>
		<div class="container-fluid well span6">
			<hr class="theo-footer-hr">
			<?php
				$id = htmlspecialchars($_GET['id']);
				$sql = "SELECT * FROM theo_books WHERE BookID = '$id'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$res_bookimage = "book_image/" . htmlspecialchars($row['BookImage']);
			?>
			 <div class="row">
			 	<div class="span2">
					<h4>Book Image</h4>
					<img src="<?php echo htmlspecialchars($res_bookimage); ?>" alt="image" height="400px" width="300px">
				</div>
				<div class="span8" style="margin-left: 330px; margin-top: -370px;">
					<h3>Book ID:&nbsp; <?php echo htmlspecialchars($row['BookID']); ?> </h3>
					<h3>Book Title:&nbsp; <?php echo htmlspecialchars($row['BookName']); ?> </h3>
					<h3>Book Subtitle:&nbsp; <?php echo htmlspecialchars($row['BookType']); ?> </h3>
					<h3>Book ISBN:&nbsp; <?php echo htmlspecialchars($row['ISBN']); ?></h3>
					<h3>Author:&nbsp; <?php echo htmlspecialchars($row['Author']); ?> </h3>
					<h3>Date Posted:&nbsp; <?php echo htmlspecialchars($row['BookPostDate']); ?> </h3>
					<a class="btn btn-primary" data-toggle="modal" data-target="#bookModal">Reserve this book</a>
				</div>
			</div>
		</div>
	</div>

<?php
	if (isset($_POST['btn_reserved'])) {

		$reservation = mysqli_real_escape_string($conn, $_POST['date_reserved']);
		$id = htmlspecialchars($_POST['id']);
		$reserve_sql = "SELECT UserLName, UserFName, UserMName, BookName, BookImage,  ReservationDate FROM reservation INNER JOIN users USING(UsersID) INNER JOIN theo_books USING(BookID) WHERE ReservationDate = '$id' ORDER BY ReservationDate";
		$reserve_res = mysqli_query($conn, $reserve_sql);

		if ($reserve_res) {
			echo "<script>
				alert('Reservation successfull');
			</script>";
		} else {
			echo "<script>
				alert('Failure to reserve a book');
			</script>";
		}
	}

?>
	<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/mdb.min.js"></script>
  <script>
  		$('.datepicker').pickadate();
  </script>
</body>
</html>
