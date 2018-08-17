<?php
	include ('../connection.php');

	//Delete
	//Check the del variable is set in url

	//annoucements
	if (isset($_GET['del']) && is_numeric($_GET['del'])) {
		
		$id = $_GET['del'];
		$sql = "DELETE FROM announcement WHERE 
		AnnouncementID = '$id'";
		$result = mysqli_query($conn, $sql);
		header('Location: admin-view-previous-announcement.php');
	}

	//admins
	 if (isset($_GET['del']) && is_numeric($_GET['del'])) {
		$id = $_GET['del'];
		$sql = "DELETE FROM admin WHERE AdminID = '$id'";
		$result = mysqli_query($conn, $sql);
		header('Location: admin-account-management.php');
	}

	//books
	if (isset($_GET['del']) && is_numeric($_GET['del'])) {
		$id = $_GET['del'];
		$sql = "DELETE FROM theo_books WHERE BookID = '$id'";
		$result = mysqli_query($conn, $sql);
		header('Location: admin-view-books.php');
	} else {
		header('Location: admin-view-books.php');
	}

?>