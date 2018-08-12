<!DOCTYPE html>
<html>
<head>
    <title> College of Theology Library</title>
    <meta content="College of Theology Library">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"> 
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-4">
<!-- Login Form here-->
<?php include ('library/forms/login_form.php'); ?>
<?php
    session_start();
    include ('connection.php');

    $time = time();

    if (isset($_POST['login'])) {

        //variables. Define username and password
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        //protect from MySQL Injection
        $username = stripslashes($username);
        $password = stripslashes($password);
        $password = mysqli_real_escape_string($conn, $password);

        //query
        $user_check = "SELECT UsersID, UserLName, UserFName, 
        UserMName, UserType, UserEmail, UserGender, UserBirthday, UserContactNumber, 
        Username, UserPassword FROM users WHERE Username = '". mysqli_real_escape_string($conn, $username) . "'";
        
        $result = mysqli_query($conn, $user_check);
        $count = mysqli_num_rows($result); //check if username is existing
        $row = mysqli_fetch_assoc($result); //fetch info of registered user

        //db variables
        $res_id = htmlspecialchars($row['UsersID']);
        $res_username = htmlspecialchars($row['Username']);
        $res_pass = htmlspecialchars($row['UserPassword']);
        $res_firstname = htmlspecialchars($row['UserFName']);
        $res_midname = htmlspecialchars($row['UserMName']);
        $res_lastname = htmlspecialchars($row['UserLName']);
        $res_type = htmlspecialchars($row['UserType']);
        $res_email = htmlspecialchars($row['UserEmail']);
        $res_contactnum = htmlspecialchars($row['UserContactNumber']);
        $res_gender = htmlspecialchars($row['UserGender']);
        $res_birthday = htmlspecialchars($row['UserBirthday']);

        if ($count > 0) {
            if ($res_pass == $password) {

                //session variables
                $_SESSION['userid'] = $res_id;
                $_SESSION['username'] = $res_username;
                $_SESSION['firstname'] = $res_firstname;
                $_SESSION['midname'] = $res_midname;
                $_SESSION['lastname'] = $res_lastname;
                $_SESSION['type'] = $res_type;
                $_SESSION['email'] = $res_email;
                $_SESSION['contact_num'] = $res_contactnum;
                $_SESSION['password'] = $res_pass;
                $_SESSION['gender'] = $res_gender;
                $_SESSION['birthday'] = $res_birthday;
                header("location: home.php");
                 
                 //User logs
                 $filename = "system/user_login.txt";
                 $fp = fopen($filename, 'a+');
                 fwrite($fp, " " . $username . " | " . $password . " | " . date("l jS \of F Y h:i:s A", $time). "\n");
                 fclose($fp);
                 die();

            } else {
                  echo "
                  <div class='alert alert-danger text-center'>
                    Incorrect password</div>";
                  exit();
            } 
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid Username</div>";
            exit();
        }
        mysqli_close($conn);
    }
?>
<!--JavaScript Libraries-->
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/mdb.min.js"></script>
<script>

function show() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("show_pass").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
        }
    }, false);
</script>
</body>
</html>