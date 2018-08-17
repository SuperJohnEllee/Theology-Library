<?php 
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = $_SESSION['admin_user'];

	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	} else {
		
	}
	include ('../connection.php');

	$sql = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 36 DAY_HOUR";
	$res_sql = mysqli_query($conn, $sql);
	$announcement_row = mysqli_fetch_assoc($res_sql);
	$announcement_count = mysqli_num_rows($res_sql);	
?>

<!DOCTYPE html>
<html> 
<head>
	<meta http-equiv="Content-Type" charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=gy.0">
	<title>College of Theology</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<style>.icon{font-size: 30px;}</style>
<body class="cyan lighten-5" role="document" oncontextmenu="return false">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br>
<div class="container"><br>
	<div class="page-header">
		<h1 class="text-center"><span class="fa fa-bullhorn"></span> Post an Announcement</h1>
		<br>
		<hr class="theo-footer-hr">
	</div>
	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">	
			<form id="AddAnnoucementForm" method="post" enctype="multipart/form-data">
				<p>Note: Please input an image when you post an announcement</p>
				<div class="md-form">
					<i class="fa fa-image prefix"></i>
					<input type="file" name="image" id="image" required>
				</div>
				<div class="md-form">
					<i class="fa fa-header prefix"></i>
					<input class="form-control" type="text" id="title" name="title" required>
					<label>Title</label>
				</div>
				<div class="md-form">
					<i class="fa fa-pencil prefix"></i>
					<textarea class="form-control md-textarea" id="AddAnnounceForm_Cont" onFocus="countChars('AddAnnounceForm_Cont','text-counter',1000)" onKeyDown="countChars('AddAnnounceForm_Cont','text-counter',1000)"
					onKeyUp="countChars('AddAnnoucementForm','text-counter',1000)" name="content" rows="7" style="resize: none; margin-bottom:8px;"autofocus required maxlength="1001"></textarea>
					<label for="content">Content</label>
				</div>
				<span style="color: gray;">Post as <span class="font-weight-bold"><?php echo htmlspecialchars($session_admin_user); ?></span></span>
				<button class="btn btn-info pull-right" type="submit" name="post" id="btn_post"><i class="fa fa-paper-plane"></i>&nbsp;Post</button>
				<span class="pull-right" id="text-counter" style="margin-top:8px;margin-right:8px; color:gray;">&nbsp;1000</span>
			</form>
		</div>
	</div>
	<hr class="divider">
	<div class="table-scrol">
		<h1 class="text-center">Your Latest Announcement(<?php echo htmlspecialchars($announcement_count); ?>)</h1>
		<br>
		<a class="btn btn-primary" href="admin-view-previous-announcement.php"><span class="fa fa-history"></span> View All Announcements</a>
		<!--<h6>Note: Delete an announcement every 4-5 Days</h6> -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-inverse">
					<tr>
						<th colspan="1">Image</th>
						<th colspan="1">Announcement ID</th>
						<th colspan="1">Title</th>
						<th colspan="1">Content</th>
						<th colspan="1">Date</th>
						<th colspan="1">Posted By</th>
						<th class="text-center" colspan="2">Action</th>
					</tr>
				</thead>
				<?php
					$view_announcement = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 36 DAY_HOUR ORDER BY PostDate DESC";
					$res_announce = mysqli_query($conn, $view_announcement);
					$count = mysqli_num_rows($res_announce);

					if ($count > 0) {
			
					while ($row = mysqli_fetch_array($res_announce)) {
						echo '<tr><td><img src="../announcement_page/'.$row['Image'].'" style="width:200px; height:200px;"></td>';
						echo '<td>'.htmlspecialchars($row['AnnouncementID']);'</td>';
						echo '<td>'.htmlspecialchars($row['Title']).'</td>';
						echo '<td>'.htmlspecialchars($row['Content']).'</td>';
						echo '<td>'.htmlspecialchars($row['PostDate']).'</td>';
						echo '<td>'.htmlspecialchars($row['PostBy']).'</td>';
						echo '<td><a class="btn btn-primary" href="admin-edit-announcement.php?id='.$row['AnnouncementID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
						echo '<td><a class="btn btn-danger" href="admin-delete.php?del='.$row['AnnouncementID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
					}
				} else {
					echo "<h3 class='alert alert-warning text-center'><span class='fa fa-warning'></span> There are no Announcements Posted</h3";
				}
				?>
			</table>
		</div>
	</div>
</div>
<script>
	function countChars(textbox, counter, max) {
  var count = max - document.getElementById(textbox).value.length;
  if (count < 0) { document.getElementById(counter).innerHTML = "<span style=\"color: red;\">" + count + "</span>";
  	  document.getElementById('btn_post').disabled = true;
} else { document.getElementById(counter).innerHTML = count;
		 document.getElementById('btn_post').disabled = false; }
}
</script>
<?php

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		$announcement_image = mysqli_real_escape_string($conn, '../announcement_image/'.$_FILES['image']['name']);

		if (preg_match("!image!", $_FILES['image']['type'])) {
			if (copy($_FILES['image']['tmp_name'], $announcement_image)) {
				$insert_news = "INSERT INTO announcement(Image,Title, Content, PostBy, PostDate) VALUES
				('$announcement_image', '$title', '$content', '$session_admin_user', NOW())";
				$result = mysqli_query($conn, $insert_news);
				if ($result) {
					echo "<script>
						alert('Successfully created an announcement');
					</script>
					<meta http-equiv='refresh' content='0; url=announcement.php'>";
				} else {
					echo "<script>
						alert('Error: Failure in creating an announcement');
					</script>";
				}
			} else {
				echo "<script>
					alert('Image upload failed');
				</script>";
			}
		} else {
			echo "<script>
				alert('Invalid type of file');
			</script>";
		}
		mysqli_close($conn);
	}
?>
<!--JavaScript Libraries-->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/popper.min.js"></script>
 <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/bootstrap.min.js"></script>
 <script src="../js/mdb.min.js"></script>

   <script>
     
     new WOW().init();
		// Material Select Initialization
	$(document).ready(function() {
   	$('.mdb-select').material_select();
 	});
	</script>
</body>
</html>