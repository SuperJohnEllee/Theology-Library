<!DOCTYPE html>
<?php
	session_start();
	$admin_user = htmlspecialchars($_SESSION['admin_user']);

	if (!$admin_user) {
		session_unset();
		session_destroy();
		header('location: index.php');
	}

	include ('../connection.php');
	$reserve_sql = "SELECT book_reservationID FROM reservation";
	$reserve_res = mysqli_query($conn, $reserve_sql);
	$reserve_count = mysqli_num_rows($reserve_res);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
		<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
			</div>
		</div>
	</nav><br><br><br>
	<div class="table-scrol">
		<h1 class="text-center"><span class="fa fa-bookmark"></span> Reserve Books(<?php echo htmlspecialchars($reserve_count); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3>List of Reserved Books</h3>
				<hr class="theo-footer-hr">
			</div>
			<br>
			<form class="form-horizontal" method="post">
				<div class="form-group col-lg-9">
					<div class="input-group">
						<input class="form-control" type="text" name="request_search" id="request_search">
						<button class="btn btn-primary" name="btn_res_search"><span class="fa fa-search"></span> Search</button>
					</div>
				</div>
			</form>
			<table class="table table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col">Reservation ID</th>
							<th scope="col">Full Name</th>
							<th scope="col">Book Name</th>
							<th scope="col">Reservation Date</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
				</table>
		</div>
	</div>
</body>
</html>