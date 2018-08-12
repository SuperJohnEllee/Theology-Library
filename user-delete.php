<?php
if (isset($_GET['del']) && is_numeric($_GET['del'])) {
		
		$id = $_GET['del'];
		$sql = "DELETE FROM book_request WHERE book_requestID = '$id'";
		$result = mysqli_query($conn, $sql);
		header('Location: user-request-book-history.php');
	} else {
		header('Location: user-request-book-history.php');
	}
?>