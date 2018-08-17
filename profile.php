<?php
	include ('session.php');
	include ('connection.php');

	$age_sql = "SELECT UsersID, (DATEDIFF(CURRENT_DATE, STR_TO_DATE(UserBirthday, '%Y-%m-%d'))/ 365) as Age FROM users WHERE UsersID = '$session_id'";
	$age_res = mysqli_query($conn, $age_sql);
	$age_row = mysqli_fetch_assoc($age_res);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo htmlspecialchars($session_name); ?>'s Profile</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
	<style>.icon{font-size:25px;}.bg-accupdate{background: linear-gradient(to bottom, #00ffff 0%, #ffffcc 100%);}</style>
</head>
<body oncontextmenu="return false" class="cyan lighten-5">	
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav>
	<br><br><br>
	<h2 class="text-center">College of Theology Library</h2>
	<br>
	<div class="container">
		<div class="page-header">
			<h3>User Profile</h3>
		</div>
		<div class="col-md-9">
			<hr class="theo-footer-hr">
			<div class="form-group">
				<h4>Username:&nbsp;<?php echo htmlspecialchars($session_user); ?></h4>
			</div>
			<div class="form-group">
				<h4>Name:&nbsp;<?php echo htmlspecialchars($session_fullname); ?></h4>
			</div>
			<div class="form-group">
				<h4>Type:&nbsp;<?php echo htmlspecialchars($session_type); ?></h4>
			</div>
			<div class="form-group">
				<h4>Gender:&nbsp;<?php echo htmlspecialchars($session_gender); ?></h4>
			</div>
			<div class="form-group">
				<h4>Birthday:&nbsp;<?php echo htmlspecialchars($session_birthday); ?></h4>
			</div>
			<div class="form-group">
				<h4>Age:&nbsp;<?php echo htmlspecialchars(round($age_row['Age'])); ?></h4>
			</div>
			<div class="form-group">
				<h4>Email:&nbsp;<?php echo htmlspecialchars($session_email); ?></h4>
			</div>
			<div class="form-group">
				<h4>Contact Number:&nbsp;<?php echo htmlspecialchars($session_contact_num); ?></h4>
			</div>
			<div class="row">
				<div class="form-group">
					<a class="btn btn-lg btn-primary" data-toggle="modal" data-target="#editModal"><span class="fa fa-edit"></span> Edit Profile</a>
				</div>
				<div class="form-group">
					<a href="change-password.php?<?php echo htmlspecialchars($session_user); ?>" class="btn btn-lg btn-dark"><span class="fa fa-lock"></span> Change Password</a> 
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
        	<div class="modal-content cyan lighten-5">
            	<div class="modal-header text-center cyan lighten-3 ">
                	<h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-edit"></span> Edit Profile for profile 
                	<i class="text-warning"><?php echo htmlspecialchars($session_user); ?></i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
			<p class="text-center">Note: Do not change your username</p>
            <div class="modal-body mx-3">
			    <form action="profile.php" method="post">
			    	<div class="md-form mb-5">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo htmlspecialchars($session_id); ?>">
                        <label class="sr-only" data-error="wrong" data-success="right" for="lastname">User ID</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo htmlspecialchars($session_lastname); ?>">
                        <label data-error="wrong" data-success="right" for="lastname">Lastname</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="firstname" id=firtname" class="form-control" value="<?php echo htmlspecialchars($session_firstname); ?>">
                        <label data-error="wrong" data-success="right" for="firtname">Firstname</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="midname" id="midname" class="form-control" value="<?php echo htmlspecialchars($session_midname); ?>">
                        <label data-error="wrong" data-success="right" for="midname">Middle Name</label>
                    </div>

                    <!--<div class="md-form mb-5">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="lastname" id="username" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="username">Username</label>
                    </div> -->
                    <div class="md-form mb-4">  
                        <button type="submit" class="btn btn-default pull-right" name="btn_save" data-loading-text="Logging in.."> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

	$time = time();

	if (isset($_POST['btn_save'])) {

		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$firtname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$midname = mysqli_real_escape_string($conn, $_POST['midname']);

		$sql = "UPDATE users 
		SET UserLName = '$lastname',
			UserFName = '$firtname',
			UserMName = '$midname'
			WHERE UsersID = '$session_id'";

		if (mysqli_query($conn, $sql)) {
			echo "<script>
				alert('Update Successfully');
			</script>
			<meta http-equiv='refresh' content='0; url=profile.php'>";

				$filename = "system/update_user_profile.txt";
                 $fp = fopen($filename, 'a+');
                 fwrite($fp, " " . $session_user . " updated his/her account to " . $firtname . " | " . $midname . " | " . " | " . $lastname ." | ". date("l jS \of F Y h:i:s A", $time). "\n");
                 fclose($fp);
                 die();
		} else {
			echo "";
		}

	}
?>
<!-- JavaScript Libraries -->
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
</body>
</html>