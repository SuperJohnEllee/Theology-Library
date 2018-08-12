<?php
	if (isset($_GET['del']) && is_numeric($_GET['del'])) {
		
		$id = $_GET['del'];
		$sql = "DELETE FROM announcement WHERE 
		AnnouncementID = '$id'";
		$result = mysqli_query($conn, $sql);
		header('Location: announcement.php');
	} else {
		header('Location: announcement.php');
	}
?>