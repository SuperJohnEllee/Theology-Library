<?php
	session_start();
	$session_admin_id = htmlspecialchars($_SESSION['admin_id']);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_firstname =htmlspecialchars($_SESSION['firstname']);
	$session_admin_midname = htmlspecialchars($_SESSION['midname']);
	$session_admin_lastname = htmlspecialchars($_SESSION['lastname']);
	if (!$_SESSION['admin_user']) {
		header("location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>College of Theology Administration</title>
	<meta http-equiv="Content-Type" charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">

	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbar" aria-controls="navbar" aria-expanded="false" aria-lablled="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>   
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
	</nav><br><br><br>
	<h2 class="text-center">Account Management</h2>
	<div class="container">
		<div class="page-header">
			<h1>Edit Profile
				<small> for account <i><?php echo $session_admin_user; ?></i></small>
			</h1>
		</div>
		<hr class="divider">
		<div class="col-md-9 personal-info">
			<form class="form-horizontal" role="form" action="admin-edit-account.php" method="post">
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<input class="form-control" type="hidden" name="id" value="<?php echo $session_admin_id; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>
						<input class="form-control" type="text" name="admin_lname" value="<?php echo $session_admin_lastname ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>
						<input class="form-control" type="text" name="admin_fname" placeholder="First Name" value="<?php echo $session_admin_firstname; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>
						<input class="form-control" type="text" name="admin_mname" value="<?php echo $session_admin_midname?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-user fa-2x"></i></div>
						<input class="form-control" type="text" name="admin_user" value="<?php echo $session_admin_user ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-9">
						<div class="input-group">
							<input class="btn btn-primary" type="submit" name="save" value="Save Changes">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php
	include ('../connection.php');
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$res = mysqli_query($conn, "SELECT * FROM admin WHERE AdminID = '$id'");
	}
	if (isset($_POST['save'])) {

		$lastname = mysqli_real_escape_string($conn, $_POST['admin_lname']);
		$firstname = mysqli_real_escape_string($conn, $_POST['admin_fname']);
		$midname = mysqli_real_escape_string($conn, $_POST['admin_mname']);
		$username = mysqli_real_escape_string($conn, $_POST['admin_user']);


		$sql = "UPDATE admin SET 
		AdminLName = '$lastname',
		AdminFName = '$firstname',
		AdminMName = '$midname',
		AdminUser = '$username' WHERE AdminID = '$id'";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			echo "<script>
				alert('Update profile successfully');
			</script>
			<meta http-equiv='refresh' content='0; 
			url=admin-account.php?remarks=success'";
		} else {
			echo "<script>
				alert('Error in updating profile');
			</script>";
		}
	}

?>
<!--JavaScript Libraries-->
<script src="..js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="..js/mdb.min.js"></script>
</body>
</html>