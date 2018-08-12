		<?php

			include ('../connection.php');
			if ($session_admin_user) {
				//user logged in
				//create a change pass form

				if (isset($_POST['btn_change'])) {

					//variables here
					$oldpass = $_POST['oldpass'];
					$newpass = $_POST['newpass'];
					$conf_pass = $_POST['conf_pass'];

					//protect from MySQL Injection
					$oldpass = stripslashes($_POST['oldpass']);
					$newpass = stripslashes($_POST['newpass']);
					$conf_pass = stripslashes($_POST['conf_pass']);

					$sql = mysqli_query($conn, "SELECT * FROM admin WHERE AdminUser = '$session_admin_user'");
					//fetch registered password
					$row = mysqli_fetch_assoc($sql);
					$res_oldpass = $row['AdminPass'];

					//check passwords
					if ($oldpass == $res_oldpass) {
						//check two passwords

						if ($newpass == $conf_pass) {
							//success
							//change password

							$sql_change = mysqli_query($conn, "UPDATE admin SET AdminPass ='$newpass' WHERE AdminUser='$session_admin_user'");
							echo "<script>
								alert('Your password has been changed');
							</script>
							<meta http-equiv='refresh'; content='0; 
							url=admin-account.php?remarks=success'>";

							//Update password logs
							$filename = "../system/update_admin_pass.txt";
							$fp = fopen($filename, 'a+');
							fwrite($fp, " " . $session_admin_user . " updated the account's password to " . 
								$newpass . " | " . date("l jS \of F Y h:i:s A"). "\n");
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
					<button type='submit' name='btn_change' class='btn btn-primary' id='ChangePassForm_Submit' data-loading-text='Changing Password...''><span class='fa fa-download'></span> Submit</button>
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