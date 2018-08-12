<?php
session_start();
$session_user = htmlspecialchars($_SESSION['username']);

	if (!$session_user) {
		header("location: 404_page.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta content="College of Theology Library">
	<meta name="viewport" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0" charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body>
	<h2 class="text-center">College of Theology Library</h2>
	<br>
	<div class="container">
		<h5>Make a Reservation</h5>
		<hr class="divider">
		<div class="col-md-10">
			<form class="form-horizontal" role="form" action="" method="post">
				<div class="form-group">
					<label class="control-label col-sm-4" for="username">Name:</label>
					 <div class="col-sm-8">
					    <input type="text" class="form-control" name="name" id="usernames" required placeholder="Enter Name">
					 </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="email">Email:</label>
					 <div class="col-sm-8">
					 	<input type="email" class="form-control" name="email" id="usernames" required placeholder="Enter Email">
					 </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="contact_num">Contact Number</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="contact_num" required placeholder="Contact Number">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="book_title">Book Title</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="book_title" required placeholder="Book Title">
					</div>
				</div>
				<div class="md-form">
					<div class="col-sm-8">
						<input class="form-control datepicker" type="date" name="date">
						<label for="date">Date of Reservation</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-2">
						<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-chevron-circle-right"></i>&nbsp;Submit</button>
					</div>
				</div>	  
			</form>
		</div>
	</div>
<!--JavaScript Libraries-->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/mdb.min.js"></script>
	<script>
		// Date Picker Initialization
		$('.datepicker').pickadate();
	</script>
</body>
</html>