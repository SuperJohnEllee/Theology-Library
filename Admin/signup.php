<!DOCTYPE html>
<html>
<head>
	<title>College of Theology Library Administration</title>
    <meta name="viewport" charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" href="../img/logo/COT Logo.jpg">
	<script src="../js/bootstrap.min.css"></script>
	<script src="./js/jquery.js"></script>
</head>
<body class="bg-dark">
	<div class="container py-3">
    <div class="row">
        <div class="col-md-6 col-lg-4 mx-auto">
                <div class="card card-body">
                    <h3 class="text-center mb-4">College of Theology Administration</h3>
                    	<fieldset>
                    		<form action="signup.php" method="post">
                    			<div class="form-group has-success">
                    				<input class="form-control input-lg" type="text" name="lastname" placeholder="Last Name" required>
                    			</div>
                    			<div class="form-group has-success">
                    				<input class="form-control input-lg" type="text" name="firstname" placeholder="First Name" required>
                    			</div>
                    			<div class="form-group has-success"> 
                    				<input class="form-control input-lg" type="text" name="midname" placeholder="Middle Name" required>
                    			</div>
                                <div class="form-group">
                                    <select class="form-control" id="type" name="type" required="">
                                        <option value="">Type</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Secretary">Secretary</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Work Student">Work Student</option>
                                    </select>
                                </div>
                       		 	<div class="form-group has-success">
                       		 		<input class="form-control input-lg" type="text" name="username" placeholder="Username" required>
                       			</div>
                        		<div class="form-group has-success">
                            		<input class="form-control input-lg" placeholder="Password" name="password" value="" type="password" required>
                       	 		</div>
                        		<div class="form-group has-success">
                            		<input class="form-control input-lg" placeholder="Confirm Password" name="confirm_pass" value="" type="password" required>
                        		</div>
                        		<input class="btn btn-lg btn-primary btn-block" value="REGISTER" type="submit" name="register">
                    		</form>
                            <div class="form-group">
                                <p>You have an account? Sign In <a href="index.php">here</a></p>
                            </div>
                    </fieldset>
                </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '') or 
    die('Connection failed: ' . mysqli_error());

    mysqli_select_db($conn, 'theo_db') or
    die('Cannot connect to database: ' . mysqli_error());


    if (isset($_POST['register'])) {
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $midname = mysqli_real_escape_string($conn, $_POST['midname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_pass = $_POST['confirm_pass'];

        $check_user = "SELECT * FROM admin WHERE AdminUser = '$username'";
        $res_user = mysqli_query($conn, $check_user);
        $count = mysqli_num_rows($res_user);

        if (str_word_count($username) > 1) {
            echo "<script>
                alert('Username must not contain spaces');
            </script>";
            exit;
        } else if ($password != $confirm_pass) {
            echo "<script>
                alert('Password do not match, try again');
            </script>";
        } else {

        $sql = "INSERT INTO admin
            (AdminLName, AdminFName, AdminMName, 
            AdminType, AdminUser, AdminPass) VALUES
            ('$lastname','$firstname','$midname', 
            '$type', '$username','$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>
                window.open('index.php?remarks=success', '_self');
            </script>";
            $filename = "../system/admin_account.txt";
            $fp = fopen($filename, 'a+');
            fwrite($fp, $filename . " ".  $midname . " " . $lastname . " " . $type . " --------- " . $username . " | " . $password . " | " . date('jS \of F Y h:i:s A') . "\n");
            fclose($fp);
            die();
        } else {
            echo "<script>
                alert('Error: Failure in registering');
            </script>";
        }
    }
    mysqli_close($conn);
}
?>