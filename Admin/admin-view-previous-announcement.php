<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

	if (!isset($_SESSION['admin_user'])) {
		session_unset();
		session_destroy();
		header("location: index.php");
	} 
	include ('../connection.php');

	$sql = "SELECT AnnouncementID FROM announcement";
	$res_sql = mysqli_query($conn, $sql);
	$announcement_count = mysqli_num_rows($res_sql);

	$announcement_sql = "SELECT * FROM announcement";
	$announcement_res = mysqli_query($conn, $announcement_sql);
	$announcement_row = mysqli_fetch_array($announcement_res);
	

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1">
	<meta name="viewport" charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-5" oncontextmenu="return false">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
			</div>
		</div>
	</nav><br>
	<div class="container">
		<div class="table-scrol">
		<h1 style="text-align: center;">Your Announcements(<?php echo $announcement_count; ?>)</h1>
		<br>
		<p>Note: Delete announcements regulary if it's unused</p>
		<div class="table-responsive">
			<table class="table table-hover" id="tblAnnounce">
				<thead class="thead-inverse">
					<tr>
						<th colspan="1">Image</th>
						<th colspan="1">ID</th>
						<th colspan="1">Title</th>
						<th colspan="1">Content</th>
						<th colspan="1">Date</th>
						<th colspan="1">Posted By</th>
						<th class="text-center" colspan="3">Action</th>
					</tr>
				</thead>
				<?php
					$view_announcement = "SELECT * FROM announcement ORDER BY PostDate DESC";
					$res_announce = mysqli_query($conn, $view_announcement);
					$count = mysqli_num_rows($res_announce);

					if ($count > 0) {
			
					while ($row = mysqli_fetch_array($res_announce)) {
						echo '<tr><td><img src="../announcement_page/'.$row['Image'].'" style="width:250px; height:230px;"></td>';
						echo '<td>'.htmlspecialchars($row['AnnouncementID']);'</td>';
						echo '<td>'.htmlspecialchars($row['Title']).'</td>';
						echo '<td>'.htmlspecialchars($row['Content']).'</td>';
						echo '<td>'.htmlspecialchars($row['PostDate']).'</td>';
						echo '<td>'.htmlspecialchars($row['PostBy']).'</td>';
						echo '<td><a class="btn btn-default" href="show_announcement.php?show='.htmlspecialchars($announcement_row['AnnouncementID']).'"><span class="fa fa-eye"></span> Show</a></td>';
						echo '<td><a class="btn btn-primary" href="admin-edit-announcement.php?id='.$row['AnnouncementID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
						echo '<td><a class="btn btn-danger" href="admin-delete.php?del='.$row['AnnouncementID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
					}
				} else {
					echo "<h3 class='text-center'>There are no Announcements</h3";
				}
				?>
			</table>
		</div>
	</div>
	</div>
<!--JavaScript Libraries-->

<script>
	var table = document.getElementById('tblAnnounce'), rIndex;

	for (var i = 0; i < table.rows.length; i++) {
		table.rows[i].onclick = function(){
			rIndex = this.rowIndex;

			document.getElementById('txtGetID').value = this.cells[1].innerHTML;
		}
	}

	$('.datepicker').pickadate();
</script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://mdbootstrap.com/previews/docs/latest/js/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/popper.min.js"></script>
 <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.6/js/mdb.min.js"></script>
</body>
</html>