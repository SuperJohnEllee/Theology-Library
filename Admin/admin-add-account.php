<?php
	session_start();
	$session_user = $_SESSION['admin_user'];
	if (!$session_user) {
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" charset="utf-8">
  	<meta name="description" content="width=device-width, initial-scale=1.0">
  	<meta name="author">
  	<meta http-equiv="Content-Type">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav>
	<div class="container">
		<div class="page-header">
			<h3>Add New Admin</h3>
		</div><br><br>
			<h3 class="text-center"><i class="fa fa-user"></i>&nbsp;Add Admin</h3>
			<hr class="theo-footer-hr">
			<form class="form-horizontal" action="" method="post">
			<div class="row">	
				<div class="form-group col-lg-6">
					<label class="control-label col-sm-4" for="lastname">Last Name:</label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user icons"></i></div>
								<input class="form-control" type="text" name="lastname" required placeholder="Last Name">
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6">
					<label class="control-label col-sm-4" for="firstname">First Name:</label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user icons"></i></div>
								<input class="form-control" type="text" name="firstname" required placeholder="First Name">
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6">
					<label class="control-label col-sm-4" for="midname">Middle Name:</label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user icons"></i></div>
								<input class="form-control" type="text" name="midname" required placeholder="Middle Name">
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6">
					<label class="control-label col-sm-4" for="username">Username: </label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user icons"></i></div>
							<input class="form-control" type="text" name="username" required placeholder="Username">
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6">
					<label class="control-label col-sm-4" for="password">Password: </label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock icons"></i></div>
							<input class="form-control" type="password" name="password" required placeholder="Password"">
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6">
					<label class="control-label">Retype Password: </label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock icons"></i></div>
							<input class="form-control" type="password" name="confirm_pass" required placeholder="Retype Password">
						</div>
					</div>
				</div>
					<div class="col-lg-5">
						<button class="btn btn-primary btn-lg" type="submit" name="btn_add"><i class="fa fa-plus"></i>&nbsp;Add</button>
					</div>
			</div>
			</form>
	</div>
	<!--JavaScript Libraries -->
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jquery.js"></script>
  	<script src="../js/popper.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
  	<script src="../js/jquery.min.js"></script>
  	<script src="../js/mdb.min.js"></script>

<?php
	include ('../connection.php');

	if (isset($_POST['btn_add'])) {

 		 	$lastname = $_POST['lastname'];
 		 	$firstname = $_POST['firstname'];
 		 	$midname =  $_POST['midname'];
 		 	$username = $_POST['username'];
 		 	$password =  $_POST['password'];
 		 	$confirm_pass = $_POST['confirm_pass'];

 		 	$check_user = "SELECT * FROM admin WHERE AdminUser = '$username'";
       		 $res_user = mysqli_query($conn, $check_user);
       		 $count = mysqli_num_rows($res_user);
			
			 if (str_word_count($username) > 1) {
       		 	
       		 	echo "<script>
       		 		alert('Username must not contain spaces');
       		 	</script>";
       	
       		 }
       		 	$insert_query = "INSERT INTO admin
 		 		(AdminLName, AdminFName, AdminMName, AdminUser, AdminPass) VALUES
 		 		('$lastname','$firstname','$midname','$username','$password')";
 		 		$res_query = mysqli_query($conn, $insert_query);

 		 		if ($res_query) {
 		 			echo "<script>
 		 			alert('Successfully created an account');
 		 		</script>
 		 		<meta http-equiv='refresh' content='0 url=admin-account-management.php'>";
 		 		} else {

 		 			echo "<script>
 		 				alert('Failure in account submission');
 		 			</script>";
 		 		}
 		 	}
?>
</body>
</html>