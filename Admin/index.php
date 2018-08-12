<!DOCTYPE html>
<html>
<head>
	<title>College of Theology Library</title>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/login.css">
	<link href="https://fonts.apis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
    <style>.error{font-size: 25px;}</style>
</head>
<body class="elegant-color-dark">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center text-white mb-4"> College of Theology Administration</h2>
				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="card rounded-0 cyan darken-5">
							<div class="card-header cyan lighten-4">
								<h3 class="text-center"><span class="fa fa-sign-in"></span> Log In Credentials</h3>
							</div>
							<div class="card-body">
								<form class="form" action="index.php" method="post" role="form" autocomplete="off" id="formLogin">
									<div class="md-form">
                                        <i class="fa fa-user prefix text-white"></i>
										<input class="form-control form-control-lg rounded-0" type="text" name="admin_user" id="admin_user" required>
                                        <label class="text-white" for="username">Username</label>
									</div>
									<div class="md-form">
                                        <i class="fa fa-lock prefix text-white"></i>
										<input class="form-control form-control-lg rounded-0" type="password" name="admin_pass" id="admin_pass" required="" autocomplete="new-password">
                                        <label class="text-white" for="password">Password</label>
									</div>
									<button class="btn btn-success btn-lg float-right" type="submit" name="login" id="btnLogin"><i class="fa fa-sign-in"></i> Login
									</button>
								</form>
								<!--<div class="form-group">
									<p><a class="btn btn-dark" href="signup.php">Create Account</a></p>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	session_start();
    session_set_cookie_params(86400);
    
    include ('../connection.php');

    if (isset($_POST['login'])) {

        //define var
        $username = $_POST['admin_user'];
        $password = $_POST['admin_pass'];

        //Protection from SQL Injection
        $username = stripslashes($username);
        $password = stripslashes($password);
        $password = mysqli_real_escape_string($conn, $password);

         $admin_check = "SELECT AdminID, AdminLName, AdminFName, AdminMName, AdminType, AdminUser, AdminPass FROM admin WHERE AdminUser = '". mysqli_real_escape_string($conn, $username) . "'";
        $result = mysqli_query($conn, $admin_check);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        $res_admin_id = $row['AdminID'];
        $res_admin_user = $row['AdminUser'];
        $res_admin_pass = $row['AdminPass'];
        $res_admin_firstname = $row['AdminFName'];
        $res_admin_midname = $row['AdminMName'];
        $res_admin_lastname = $row['AdminLName'];
        $res_admin_type = $row['AdminType'];
        $res_admin_name = $row['AdminFName'] .' '. $row['AdminLName'];
        $res_admin_fullname = $row['AdminFName'] .' '. $row['AdminMName'] . ' ' . $row['AdminLName'];
        if ($count > 0) {
        	if ($res_admin_pass == $password) {
        	
                switch ($res_admin_type) {
                    case 'Admin':
                        echo "admin";
                        break;
                    case 'Librarian':
                        echo "librarian";
                        break;
                    case 'Secretary':
                        echo "Secretary";
                        break;
                    case 'Staff':
                        echo "Staff";
                        break;
                    case 'Work Student':
                        echo "WorkStudent";
                        break;
                    case 'Instructor':
                        echo "Instructor";
                        break;
                    default:
                        echo "error";
                        exit;
                        break;
                }

                $type = $row['AdminType'];

                $_SESSION['admin_id'] = $res_admin_id;
                $_SESSION['admin_user'] = $res_admin_user;
                $_SESSION['type'] = $res_admin_type;
                $_SESSION['firstname'] = $res_admin_firstname;
                $_SESSION['midname'] = $res_admin_midname;
                $_SESSION['lastname'] = $res_admin_lastname;
                $_SESSION['name'] = $res_admin_name;
                $_SESSION['fullname'] = $res_admin_fullname;

                if ($type == 'Admin' || $type == 'Librarian' ) {
                    header("location: adminHome.php");
                } elseif ($type == 'Secretary' || $type == 'Work Student' || 
                    $type == 'Instructor' || $type == 'Secretary' || $type == 'Staff') {
                    header("location: theology-dashboard.php");
                }
                //Login Admin logs
                 $filename = "../system/admin_login.txt";
                 $fp = fopen($filename, 'a+');
                 fwrite($fp, " " . $username . " | " . $password . " | " . date("l jS \of F Y h:i:s A"). "\n");
                 fclose($fp);
                 die();
                
        	} else {
        		echo "<div class='alert alert-danger error text-center'>
                    Incorrect Password </div>";
        	}
        } else {
        	echo "<div class='alert alert-danger error text-center'>Invalid Username
            </div>";
        }
    }
?>
<!--JavaScript Libraries-->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="..js/popper.min.js"></script>
    <script src="../js/mdb.min.js"></script>
</body>
</html>