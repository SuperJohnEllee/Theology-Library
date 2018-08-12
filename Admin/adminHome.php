<?php
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_name = htmlspecialchars($_SESSION['name']);
	$session_admin_type = htmlspecialchars($_SESSION['type']);
	if (!$session_admin_user) {
		header("location: index.php");
	} 

	include ('../connection.php');

	//Display number of Users
	$user_sql = "SELECT UsersID FROM users";
	$res_user = mysqli_query($conn, $user_sql);
	$user_count = mysqli_num_rows($res_user);

	//Display number of Books
	$book_sql = "SELECT BookID FROM theo_books";
	$res_book = mysqli_query($conn, $book_sql);
	$book_count = mysqli_num_rows($res_book);

	//Display number of Annoucement
	$announcement_sql = "SELECT AnnouncementID FROM announcement";
	$res_annoucement = mysqli_query($conn, $announcement_sql);
	$annoucement_count = mysqli_num_rows($res_annoucement);

	//Display number of Admins
	$admin_sql = "SELECT AdminID FROM admin";
	$res_admin = mysqli_query($conn, $admin_sql);
	$admin_count = mysqli_num_rows($res_admin);

	//Display number of requested books by users
	$req_sql = "SELECT book_requestID FROM book_request";
	$req_res = mysqli_query($conn, $req_sql);
	$req_count = mysqli_num_rows($req_res);

	//Display number of reserved books by users
	$reserved_sql = "SELECT book_reservationID FROM reservation";
	$reserved_res = mysqli_query($conn, $reserved_sql);
	$reserved_count = mysqli_num_rows($reserved_res);

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
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/sidebar.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="fixed-sn cyan lighten-5" onload="startTime()">
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
    <a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" alt="Logo" height="30" width="30"></a>
      <button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
    	<li class="nav-item">
    		<a class="nav-link text-white" href="#"><i class="fa fa-bell-o"></i>&nbsp;Notifications</a>
    	</li>
    	<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo htmlspecialchars($session_admin_user); ?></a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#"><span class="fa fa-dashboard"></span> Dashboard</a>
					<a class="dropdown-item" href="admin-account.php?<?php echo htmlspecialchars($session_admin_user); ?>"><span class="fa fa-user"></span> Profile</a>
					<a class="dropdown-item" href="admin-change-password.php"><span class="fa fa-cog"></span> Settings</a>
					<a class="dropdown-item" href="adminLogout.php"><span class="fa fa-sign-out"></span> Logout</a>
				</div>
		</li>
    </ul>
  </div>
</nav><br><br><br>
<h6 class="pull-right" id="date_time"></h6>
<div class="container">
		<div class="page-header">
			<h1>Hello, <?php echo htmlspecialchars($session_admin_name); ?>
			<br></h1>
				<h5><span class="font-weight-bold"><?php echo htmlspecialchars($session_admin_type); ?></span> of College of Theology Library</h5>
		</div>
		<hr class="theo-footer-hr">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="my-4 text-center">Library Administration</h2>
			</div>
			<!-- View Users -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="view_users.php"><img src="../img/icons/view-users.png" height="200px;" width="200px;"><h3>User Accounts<br><?php echo htmlspecialchars($user_count); ?></h3></a>
			</div>
			<!-- Post an Annoucement -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="announcement.php"><img src="../img/icons/annoucement.png" height="200px;" width="200px;"><h3>Manage Annoucements<br><?php echo htmlspecialchars($annoucement_count); ?></h3></a>
			</div>
			<!-- View Admin Account -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-account-management.php"><img src="../img/icons/view_admin.png" height="200px;" width="200px;"><h3>Admin Management<br><?php echo htmlspecialchars($admin_count); ?></h3></a>
			</div>
			<!-- View Book Information -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-books.php"><img src="../img/icons/view-book.png" height="200px;" width="200px;"><h3>Manage Books<br><?php echo htmlspecialchars($book_count); ?></h3></a>
			</div>
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-reservation.php"><img src="../img/icons/reservation.png" height="200px" width="200px;"><h3>Manage Reserved Books<br><?php echo htmlspecialchars($reserved_count); ?></h3></a>
			</div>
			<!--Manage Requested Books-->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-requested-books.php"><img src="../img/icons/view-requested.png" height="200px;" width="200px;"><h3>Manage Requested Books<br><?php echo htmlspecialchars($req_count); ?></h3></a>
			</div>
		</div>
	</div>
	<div style="padding: 15px 0;" class="mdb-color darken-4 text-center text-white">
        <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
    </div>
<!--JavaScript Libraries-->
<script src="../js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sidebar/0.2.2/js/sidebar.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('date_time').innerHTML = today;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

/*Night Mode*/
$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});
</script>
</body>
</html>
