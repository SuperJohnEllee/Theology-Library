<?php
	session_start();
	$session_user = $_SESSION['admin_user'];
	if (!$session_user) {
		header("location: index.php");
	}
	
	include ('../connection.php');

	$user_sql = "SELECT * FROM users";
	$user_res = mysqli_query($conn, $user_sql);
	$user_row = mysqli_fetch_assoc($user_res);
	$user_count = mysqli_num_rows($user_res);
	
	if (isset($_GET['page'])) {
		$page = htmlspecialchars($_GET['page']);
	} else {
		$page = 1;
	}

	$no_per_page = 10;
	$offset = ($page - 1) * $no_per_page;

	$page_sql = "SELECT COUNT(*) FROM users";
	$res_page = mysqli_query($conn, $page_sql);
	$page_rows = mysqli_fetch_assoc($res_page);

	$total_page_sql = "SELECT * FROM users LIMIT $offset, $no_per_page";

?>
<!DOCTYPE html>
<html>
<head>
	<title> College of Theology Library - View Users</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
		<nav class="navbar navbar-expand-lg navbar-light text-white mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br>
	<div><br>
		<h1 class="text-center"><span class="fa fa-user"></span> User Account Information(<?php echo $user_count; ?>)</h1>
		<br>
		<form action="view_users.php" method="post">
			<div class="form-group">
				<div class="input-group col-md-9">
					<input type="text" name="user_search" id="user_search" onkeyup="filterSearch()" class="form-control">
					<button class="btn btn-primary" name="btn_search"><span class="fa fa-search"></span> Search</button>
				</div>
			</div>
		</form>
		<!--<a style="float: right;" class="btn btn-primary" href="admin-user-search.php"><span class="fa fa-search"></span>&nbsp;Search User</a>-->
		<div class="table-responsive">
			<table id="user_table" class="table table-hover">
				<thead class="thead-inverse">
					<tr>
						<th>User ID</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Type</th>
						<th>Birthday</th>
						<th>Email</th>
						<th>Contact Number</th>
						<th>Username</th>
						<th>Password</th>
						<th>Registered Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php
					if (isset($_POST['btn_search'])) {
						$search = mysqli_real_escape_string($conn, $_POST['user_search']);
							$sql = "SELECT * FROM users WHERE 
									UsersID LIKE '%$search%'
								OR UserLName LIKE '%$search%'
								OR UserFName LIKE '%$search%'
								OR UserMName LIKE '%$search%'
								OR UserType LIKE '%$search%'
								OR UserEmail LIKE '%$search%'
								OR UserContactNumber LIKE '%$search%'
								OR Username LIKE '%$search%'";
							$result = mysqli_query($conn, $sql);
							$count = mysqli_num_rows($result);

				if ($count > 0) {
							
					while ($row = mysqli_fetch_assoc($result)) {

					$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr><td>'.$row['UsersID'].'</td>';
						echo '<td>'.$fullname.'</td>';
						echo '<td>'.$row['UserType'].'</td>';
						echo '<td>'.$row['UserGender'].'</td>';
						echo '<td>'.$row['UserBirthday'].'</td>';
						echo '<td>'.$user_row['Age'].'</td>';
						echo '<td>'.$row['UserEmail'].'</td>';
						echo '<td>'.$row['UserContactNumber'].'</td>';
						echo '<td>'.$row['Username'].'</td></tr>';
					}
					echo "<h3 class='alert alert-success text-center'><span class='fa fa-check'></span>
    						".$count." results found 
  							</h3>";

				} else {
					echo "<h3 class='alert alert-danger text-center'>
							<span class='fa fa-close'></span> Keyword '$search' was not found
						</h3>";
				}
			} else {

					$sql = "SELECT * FROM users ORDER BY UserRegisterDate DESC";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);
					if ($count > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
			$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr><td>'.$row['UsersID'].'</td>
								<td>'.$fullname.'</td>
								<td>'.$row['UserGender'].'</td>
							 	<td>'.$row['UserType'].'</td>
							 	<td>'.$row['UserBirthday'].'</td>
							    <td>'.$row['UserEmail'].'</td>
							    <td>'.$row['UserContactNumber'].'</td>
								<td>'.$row['Username'].'</td>
								<td>'.$row['UserPassword'].'</td>
								<td>'.$row['UserRegisterDate'].'</td>
								<td><a class="btn btn-primary" href="id='.htmlspecialchars($row['UsersID']).'" data-toggle="modal" data-target="#viewModal"><span class="fa fa-eye"></span> View</a></td>
							</tr>';
						}
				} else {
					echo "<h3 class='alert alert-warning text-center'><span class='fa fa-warning'></span> No users found</h3>";
				}
			}
				?>
			</table>
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content teal lighten-5">
            <div class="modal-header text-center teal lighten-3">
                <h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-user"></span> User Information </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<p class="text-center">User Information Details</p>
            <div class="modal-body mx-3">
            	<?php
            		$modal_user = mysqli_query($conn, "SELECT * FROM users");
            		$modal_row = mysqli_fetch_assoc($modal_user);
            		$fullname = htmlspecialchars($modal_row['UserFName']) . ' ' . htmlspecialchars($modal_row['UserMName']). ' ' . htmlspecialchars($modal_row['UserLName']);
 				?>
                <div class="md-form mb-5">
                   <h5>Name: <?php echo htmlspecialchars($fullname);  ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
		</div>
	</div>

<script>

	//filter search
function filterSearch() {
 	 var input, filter, table, tr, td, i;
  		input = document.getElementById("user_search");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("user_table");
  		tr = table.getElementsByTagName("tr");

  	for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[1];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[i].style.display = "";
      			} else {
        		tr[i].style.display = "none";
      		}
    	}       
  	}
}
	function print()
	{
		window.print();
	}
</script>
<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>