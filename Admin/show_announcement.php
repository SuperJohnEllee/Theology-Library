<?php
	
	include ('../connection.php');

	if (isset($_GET['show']) && is_numeric($_GET['show'])) {
		
		$show = htmlspecialchars($_GET['show']);
		$show_sql = "UPDATE announcement SET PostDate = NOW() WHERE AnnouncementID = '$show'";
		$show_res = mysqli_query($conn, $show_sql);
		header("location: announcement.php");
	}
?>