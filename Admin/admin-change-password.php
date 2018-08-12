<!DOCTYPE html>
<?php
	session_start();
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

	if (!$session_admin_user) {
		header("location: index.php");
	}
?>
<html>
<head>
	<meta name="viewport" charset="utf-8">
  	<meta name="description" content="width=device-width, initial-scale=1.0">
  	<meta name="author">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-4" role="document">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"><a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
	</nav><br><br>
	<div class="container"><br>
		<div class="page-header">
			<h1>
				Change Password
				<small> for account <i><?php echo $session_admin_user; ?></i></small>
			</h1>
			<hr class="theo-footer-hr">
		</div>
		<?php include ('actions/admin-change-password_form.php'); ?>
</div>

<!-- JavaScript Libraries -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/style.js"></script>
<script>
	var changepass = {
		form: document.getElementById('ChangePassForm'),
		oldpass: document.getElementById('oldpassword'),
		newpass: document.getElementById('newpassword'),
		retypepass: document.getElementById('conf_pass'),
		submit: '#ChangePassForm_Submit',
		msgbox: 'CP_msgbox'
	};
</script>
</body>
</html>