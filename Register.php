<!DOCTYPE html>
<?php
    include ('connection.php');
    $sql = "SELECT UsersID FROM users";
    $user_res = mysqli_query($conn, $sql);
    $user_count = mysqli_num_rows($user_res);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" style="background-color: #b2ebf2;">
    
<!-- Registration form here -->
<?php include ('library/forms/register_form.php'); ?>

<?php
    if (isset($_POST['register'])) {
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $midname = mysqli_real_escape_string($conn, $_POST['midname']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthday']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_pass = htmlspecialchars($_POST['confirm_pass']);


        /**$birth_year = mysqli_real_escape_string($conn, $_POST['birth_year']);
        $birth_month = mysqli_real_escape_string($conn, $_POST['birth_month']);
        $birth_day = mysqli_real_escape_string($conn, $_POST['birth_day']);
        $birthdate = htmlspecialchars($birth_month) . ' ' . htmlspecialchars($birth_day) . ', ' . htmlspecialchars($birth_year); */

        $check_user = "SELECT * FROM users WHERE Username = '$username'";
        $check_email = "SELECT * FROM users WHERE UserEmail = '$email'";
        $check_contact_num = "SELECT * FROM users WHERE UserContactNumber = '$contact_num'";

        $res_user = mysqli_query($conn, $check_user);
        $res_email = mysqli_query($conn, $check_email);
        $res_contact_num = mysqli_query($conn, $check_contact_num);

        if (mysqli_num_rows($res_user) > 0) {
            echo "<script>
            alert('This $username is already existing');
            </script>";
            exit;

        } else if (mysqli_num_rows($res_email) > 0) {
            echo "<script>
                alert('This $email is already existing');
            </script>"; 
            exit;
        } else if (mysqli_num_rows($res_contact_num) > 0) {
            echo "<script>
                alert('This $contact_num is already existing');
            </script>";
            exit;
            
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                alert('Error: $email is not a valid email address');
            </script>";
            exit;
        } else if (str_word_count($username) > 1) {
            echo "<script>
                alert('Error: $username must not contain spaces');
            </script>";
        
        } else if ($password > 6) {
            echo "<script>
                alert('Password must be 6 letters or more');
            </script>";
            exit;
        } else if ($password != $confirm_pass) {
            echo "<script>
                alert('Password do not match, try again');
            </script>";
            exit;
        } else { 

            $insert_com = "INSERT INTO users(UserLName, UserFName, UserMName, UserType, UserGender, UserBirthday, UserEmail, UserContactNumber, Username, UserPassword, UserRegisterDate) VALUES
            ('$lastname', '$firstname', '$midname', '$type', '$gender', '$birthdate', '$email', '$contact_num', 
            '$username', '$password', NOW())";

        if (mysqli_query($conn, $insert_com)) {
            echo "<script>
                    alert('Successfully created an account');
                window.open('index.php?remarks=success', '_self');
                </script>";
                
                //creating account logs
                $filename = "system/registered_users.txt";
                 $fp = fopen($filename, 'a+');
                 fwrite($fp, $firstname . " " . $midname . " ". $lastname . " -------- " . $username . " | " . $password . " | " . date('jS \of F Y h:i:s A') . "\n");
                 fclose($fp);
                 die();
        }  else {
            echo "<script>
                alert('Error: Failure in registering');
            </script>";
        }
    }

    mysqli_close($conn);
}
?>
    <!-- JavaScript Libraries -->
  <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/jquery-3.2.1.min.js"></script>
  <!-- Tooltips -->
  <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
</body>
</html>

