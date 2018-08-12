<!DOCTYPE html>
<?php
	session_start();
	$session_user = $_SESSION['admin_user'];
	if (!$session_user) {
		header('location: index.php');
	}
?>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler text-white grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav><br><br>
	<div class="container"><br>
		<div class="page-header">
			<h3>Search Users</h3>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-7">
				<h5 class="text-center">Enter User Details</h5>
				<fieldset>
					<form class="admin-user-search.php" method="post">
						<div class="form-group">
							<div id="search_area" class="input-group">
								<input class="form-control" type="text" name="user_search" id="user_search">
								<button type="submit" class="btn btn-default" name="btn_search"><span class="fa fa-search"></span>&nbsp;Search</button>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
		<table class="table table-hover">
			<thead class="thead-inverse">
				<tr>
					<th>User ID</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Email</th>
					<th>Contact Number</th>
					<th>Username</th>
					<th>Password</th>	
				</tr>
			</thead>
<?php
	include ('../connection.php');
		if (isset($_POST['btn_search'])) {
			$search = mysqli_real_escape_string($conn, $_POST['user_search']);
			$sql = "SELECT * FROM users WHERE 
				UsersID LIKE '%$search%'
				OR UserLName LIKE '%$search%'
				OR UserFName LIKE '%$search%'
				OR UserMName LIKE '%$search%'
				OR UserEmail LIKE '%$search%'
				OR UserContactNumber LIKE '%$search%'
				OR Username LIKE '%$search%'";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);

				if ($count > 0) {
							
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr><td>'.$row['UsersID'].'</td>';
						echo '<td>'.$row['UserLName'].'</td>';
						echo '<td>'.$row['UserFName'].'</td>';
						echo '<td>'.$row['UserMName'].'</td>';
						echo '<td>'.$row['UserEmail'].'</td>';
						echo '<td>'.$row['UserContactNumber'].'</td>';
						echo '<td>'.$row['Username'].'</td></tr>';
					}
					echo "<h3 class='alert alert-success text-center'><span class='fa fa-check'></span> ".$count." results found</h3";

				} else {
					echo "<h3 class='alert alert-danger text-center'><span class='fa fa-close'></span> User $search was not found</h3>";
				}
			}
?>
		</table>
	</div>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>