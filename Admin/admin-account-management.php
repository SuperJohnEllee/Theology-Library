<?php
	session_start();
	session_set_cookie_params(432000);
	$session_user = htmlspecialchars($_SESSION['admin_user']);

	if (!$session_user) {
		header("location: index.php");
	}

	include ('../connection.php');

	$admin_sql = "SELECT AdminID FROM admin";
	$admin_res = mysqli_query($conn, $admin_sql);
	$admin_count = mysqli_num_rows($admin_res);

	/*$id = htmlspecialchars($_GET['id']);
	$type_sql = "SELECT * FROM admin WHERE AdminID = '$id'";
	$type_res = mysqli_query($conn, $type_sql);
	$type_row = mysqli_fetch_assoc($type_res); */


	if (isset($_POST['btn_add'])) {

			//define variables
 		 	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
 		 	$firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
 		 	$midname = mysqli_real_escape_string($conn, $_POST['midname']);
 		 	$type = mysqli_real_escape_string($conn, $_POST['admin_type']);
 		 	$username = mysqli_real_escape_string($conn, $_POST['username']);
 		 	$password = mysqli_real_escape_string($conn, $_POST['password']);

 		 	$check_user = "SELECT * FROM admin 
 		 	WHERE AdminUser = '$username'";
 		 	$res_user = mysqli_query($conn, $check_user);
 		 	$count = mysqli_num_rows($res_user);

 		 	if ($count > 0) {
 		 		echo "<script>
 		 			alert('Username is already existing');
 		 		</script>";
 		 	}

 		 	//insertion
 		 	$insert_query = "INSERT INTO admin
 		 	(AdminLName, AdminFName, AdminMName, 
 		 	AdminType, AdminUser, AdminPass) VALUES
 		 	('$lastname','$firstname','$midname', 
 		 	'$type', '$username','$password')";
 		 	$result = mysqli_query($conn, $insert_query);

 		 	if ($result) {
 		 		echo "<script>
 		 			alert('Successfully created an account');
 		 		</script>
 		 		<meta http-equiv='refresh' content='0 url=admin-account-management.php'>";
 		 		$filename = "../system/admin_account.txt";
                   $fp = fopen($filename, 'a+');
                 	fwrite($fp, $firstname . " " . $midname . " ". $lastname . " -------- " . $username . " | " . $password . " | " . date('jS \of F Y h:i:s A') . "\n");
                 fclose($fp);
                 die();
 		 	} else {
 		 		echo "<script>
 		 			alert('Failure in account submission');
 		 		</script>";
 		 	}

 		}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta name="description" content="College of Theology Library">
	<meta name="author" content="John Ellee Robado">
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/app.css">

</head>
<body oncontextmenu="return false" class="admin cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" alt="Logo" height="30" width="30"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
</nav><br>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content cyan lighten-5">
				<div class="modal-header text-center cyan lighten-3">
					<h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-edit"></span> Edit Type</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>	
					</button>
				</div>
				<p class="text-center">Note: Change admin type if the administrator is not available</p>
				<div class="modal-body mx-3">
					<form action="admin-account-management.php" method="post">
						<div class="md-form mb-5">
							<input type="hidden" name="id" id="id">
							<i class="fa fa-user prefix dark-text"></i>
							<input class="form-control" type="text" name="type" id="type">
							<label class="sr-only" data-error="wrong" data-sucess="right" for="type"> Type </label>
						</div>
						<button class="btn btn-primary" type="submit" name="btn_save" id="btn_save">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-user"></span> Administrator Information(<?php echo htmlspecialchars($admin_count); ?>)</h1>
			<h3>Admin List<br>
				<hr class="theo-footer-hr">
				<!--<a class="btn btn-primary" href="admin-add-account.php"><i class="fa fa-plus"></i>&nbsp;Add New Admin</a>-->
			</h3>
			<p>Note: You can only add Admins, Librarians, Staffs, Secretary, Work Students and Instructors</p>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-inverse">
					<tr>
						<th>Admin ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Type</th>
						<th>Username</th>
						<th>Password</th>
						<th class="text-center" colspan="2">Action</th>
					</tr>
				</thead>
				<div class="form-group">
					<tr>
						<form class="form-horizontal" action="admin-account-management.php" method="post">
							<td><input class="form-control" type="hidden" name="adminID"></td>
							<td><input class="form-control" type="text" name="lastname" placeholder="Last Name" required></td>
							<td><input class="form-control" type="text" name="firstname" placeholder="First Name" required></td>
							<td><input class="form-control" type="text" name="midname" placeholder="Middle Name" required></td>
							<td><input class="form-control" type="text" name="admin_type" placeholder="Type" required></td>
							<td><input class="form-control" type="text" name="username" placeholder="Username" required></td>
							<td><input class="form-control" type="password" name="password" placeholder="Password" required></td>
							<td><button class="btn btn-primary" type="submit" name="btn_add"><span class="fa fa-plus"></span>&nbsp;Add</button></td>
						</form>
					</tr>
				</div>
				<?php
					$view_admin = "SELECT * FROM admin";
					$result = mysqli_query($conn, $view_admin);
					while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>
							<td>".htmlspecialchars($row['AdminID'])."</td>
							<td>".htmlspecialchars($row['AdminLName'])."</td>
							<td>".htmlspecialchars($row['AdminFName'])."</td>
							<td>".htmlspecialchars($row['AdminMName'])."</td>
							<td>".htmlspecialchars($row['AdminType'])."</td>
							<td>".htmlspecialchars($row['AdminUser'])."</td>
							<td>".htmlspecialchars($row['AdminPass'])."</td>
							<td><a class='btn btn-default'data-toggle='modal' data-target='#editModal'><span class='fa fa-edit'></span> Edit</a></td>
							<td><a class='btn btn-danger' href='admin-delete.php?del=".$row['AdminID']."'><span class='fa fa-trash'></span> Delete</a></td>
							</tr>";
					}
			?>	
			</table>
		</div>
		</div>
	</div>
	<!-- JavaScript Libraries -->
  <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/jquery-3.2.1.min.js"></script>
  <!-- Tooltips -->
  <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../js/mdb.min.js"></script>
   <script>
     
     new WOW().init();
	</script>
</body>
</html>