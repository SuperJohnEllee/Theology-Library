<?php
	$conn = mysqli_connect('localhost', 'root', '') or 
    die('Connection failed: ' . mysqli_error());

    mysqli_select_db($conn, 'theo_db') or
    die('Cannot connect to database: ' . mysqli_error());

	if (isset($_POST['btn_add'])) {
		$admin_lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$admin_firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$admin_midname = mysqli_real_escape_string($conn, $_POST['midname']);
		$admin_user = mysqli_real_escape_string($conn, $_POST['username']);
		$admin_pass = mysqli_real_escape_string($conn, $_POST['password']);

		$check_username = "SELECT * FROM admin WHERE AdminUser = '$admin_user'";

		$res_username = mysqli_query($conn, $check_username);

		if (mysqli_num_rows($res_username) > 0) {
			echo "<script>
				alert('Username is already existing');
			</script>";
		} else { $insert_admin = "INSERT INTO admin(AdminLName, AdminFName, AdminMName, AdminUser, AdminPass)
				VALUES
				('$admin_lastname', '$admin_firstname', 
				'$admin_midname' , '$admin_user', '$admin_pass');";
			
			if (mysqli_query($conn, $insert_admin)) {
			echo "<script>
				alert('Adding admin successfull');
			</script>";
			}
		}
		mysqli_close($conn);
	}
?>