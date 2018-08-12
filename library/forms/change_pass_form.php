	<?php
		include ('connection.php'); //establish connection
			if ($session_user) {
				//user logged in
				//create a change pass form

				if (isset($_POST['btn_change'])) {

					//variables. Define oldpass, newpass and confirmpass 
					$oldpass = $_POST['oldpass'];
					$newpass = $_POST['newpass'];
					$conf_pass = $_POST['conf_pass'];

					//protect from MySQL Injection
					$oldpass = stripslashes($oldpass);
					$newpass = stripslashes($newpass);
					$conf_pass = stripslashes($conf_pass);
					$oldpass = mysqli_real_escape_string($conn, $oldpass);
					$newpass = mysqli_real_escape_string($conn, $newpass);
					$conf_pass = mysqli_real_escape_string($conn, $conf_pass);

					//fetch info of registered users and finds password match
					$sql = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$session_user'");
					$row = mysqli_fetch_assoc($sql);

					$res_oldpass = htmlspecialchars($row['UserPassword']);

					//check passwords
					if ($oldpass == $res_oldpass) {
						//check the old password if match

						if ($newpass == $conf_pass) {
						
							//success
							//change password

							$sql_change = mysqli_query($conn, "UPDATE users SET UserPassword ='$newpass' WHERE Username='$session_user'");
							echo "<script>
								alert('Sucessfully updated password');
							</script>
							<meta http-equiv='refresh'; content='0 url=profile.php?remarks=success'>";

							//Update password logs
							 $filename = "system/update_user_pass.txt";
                 			$fp = fopen($filename, 'a+');
                 			fwrite($fp, " " . $session_user . " updated the account's password to ". $newpass . " | " . date("l jS \of F Y h:i:s A"). "\n");
                 			fclose($fp);
                 			die();
                 		
						} else {
							echo "<script>
								alert('Passwords do not match');
							</script>";
						}
					} else {
						echo "<script>
							alert('Old Password do not match');
						</script>";
					}

				}
				echo  "<div class='row'>
			<div class='col-lg-7'>
				<div id='CP_msgbox'></div>
				<form id='ChangePassForm' action='' method='post'>
					<!--Current Password-->
				<div class='form-group'>
					<div class='input-group'>
						<span class='input-group-addon'>Current Password:</span>
						<input class='form-control' type='password' name='oldpass' maxlength='50' id='oldpassword' required>
					</div>
				</div>
					<!-- New Password -->
				<div class='form-group'>
					<div class='input-group'>
						<span class='input-group-addon'>New Password:</span>
						<input class='form-control' type='password' name='newpass' maxlength='50' id='newpassword' required>
					</div>
				</div>
					<!-- Retype Password-->
				<div class='form-group'>
					<div class='input-group'>
						<span class='input-group-addon'>Retype Password:</span>
						<input class='form-control' type='password' name='conf_pass' maxlength='50' id='conf_pass' required>
					</div>
				</div>
				<div class='form-group'>
					<button type='submit' name='btn_change' class='btn btn-primary' id='ChangePassForm_Submit' data-loading-text='Changing Password...''> Submit</button>
				</div>
			</form>
		</div>
	</div>";
			} else {
				echo "<script>
					alert('Your must logged in first to change your password');
				<script>";
			}
		?>