<?php
	include ('session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
	<style>.icon{font-size:25px;}</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
		<h1>
			Edit Profile 
			<small>for profile <i><?php echo $session_user; ?></i></small>
		</h1>
		<hr class="divider">
		</div>
		<div class="col-md-6 personal-info">
			<form class="form-horizontal" role="form" action="edit-profile.php" method="post">
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<input class="form-control" type="hidden" name="id" value="<?php echo $session_id;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-user icon">
							</i></div>
							<input class="form-control" type="text" name="lastname" value="<?php echo $session_lastname;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-user icon"></i></div>
						<input class="form-control" type="text" name="firstname" value="<?php echo $session_firstname;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
					<div class="input-group-addon">
					<i class="fa fa-user icon"></i></div>
					<input class="form-control" type="text" name="midname" value="<?php echo $session_midname;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-envelope icon"></i></div>
						<input class="form-control" type="email" name="email" value="<?php echo $session_email;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-phone icon"></i></div>
						<input class="form-control" type="text" name="contact_num" maxlength="11" value="<?php echo $session_contact_num; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only"></label>
					<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-user icon"></i></div>
						<input class="form-control" type="text" name="username" value="<?php echo $session_user; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label sr-only"></label>
					<div class="col-md-9">
						<div class="input-group">
							<input class="btn btn-primary" type="submit" name="save" value="Save Changes">&nbsp;&nbsp;	
							<input class="btn btn-default" type="button" name="cancel" value="Cancel">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

<!-- JavaScript Libraries-->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/mdb.min.js"></script>
<?php

	include ('connection.php');

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$res = mysqli_query($conn, "SELECT * FROM users");
	}

	if (isset($_POST['save'])) {
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$midname = mysqli_real_escape_string($conn, $_POST['midname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$id = htmlspecialchars($_POST['id']);
		$sql = "UPDATE users SET 
		UserLName = '$lastname',
		UserFName = '$firstname',
		UserMName = '$midname',
		UserEmail = '$email',
		UserContactNumber = '$contact_num',
		Username = '$username' WHERE UsersID = '$id'";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			echo "<script>
				alert('Update profile successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=profile.php?remarks=success'";
		} else {
			echo "<script>
				alert('Error in updating profile');
			</script>";
		}
	}

?>
</body>
</html>