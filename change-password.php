<!DOCTYPE html>
<?php
	include ('session.php');
?>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-5" oncontextmenu="return false" role="document">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a></nav>
	<br><br>
	<div class="container"><br>
		<div class="page-header">
			<h1>
				Change Password
				<small> for account <i><?php echo $session_user; ?></i></small>
			</h1>
			<hr class="theo-footer-hr">
		</div>
		<?php include ('library/forms/change_pass_form.php'); ?>
</div>

<!-- JavaScript Libraries -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/style.js"></script>
</body>
</html>