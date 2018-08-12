<!DOCTYPE html>
<?php
	session_start();
	$sesion_admin_user = $_SESSION['admin_user'];
	if (!$sesion_admin_user) {
		header('location: index.php');
	}

	$session_user = $_SESSION['username'];				
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body>
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler text-white grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> 
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav><br><br>
	<div class="container"><br>
		<div class="page-header">
			<h3>User Login</h3>
			<hr class="theo-footer-hr">
		</div>
		<table class="table table-hover">
			<thead class="thead-inverse">
				<tr>
					<th>Users ID</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Middle Name</th>
					<th>Email</th>
					<th>Username</th>
				</tr>
			</thead>
			<?php
				include ('../connection.php');
				$sql = "SELECT * FROM users WHERE Username = '$session_user'";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td>".$row['Username']."</td></tr>";
					}
				} else {
					echo "<h3 class='text-center'><span class='fa fa-close'></span> No user logs found</h3>";
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