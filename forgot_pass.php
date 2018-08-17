<!DOCTYPE HTML>
<html>
<head>
<title>College of Theology Library</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://mdbootstrap.com/previews/docs/latest/css/mdb.min.css">
<link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" role="document" class="cyan lighten-4">
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-dark mb-4">College of Theology Library</h2>
            <div class="row">
                <div class="col-md-8  mx-auto">
                    <div class="card rounded-0">
                        <div class="card-header mdb-color darken-4">
                            <h3 class="text-center text-white mb-0">Forgot Password</h3>
                        </div>
                        <div class="card-body cyan lighten-5 text-dark">
                            <form class="form" role="form" autocomplete="off" method="post">
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix text-dark"></i>
                                    <input class="form-control" id="email" type="email" name="email" required>
                                    <label>Email</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-user prefix text-dark"></i>
                                    <input id="text" type="text" class="form-control" name="user" required>
                                    <label>Username</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-lock prefix text-dark"></i>
                                    <input id="text" type="password" class="form-control" name="user_pass" required>
                                    <label>Password</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-lock prefix text-dark"></i>
                                    <input id="text" type="password" class="form-control" name="user_conf_pass" required>
                                    <label>Confirm Password</label>
                                </div>
                            <div class="form-group">
                              <div class="col-md-8">
                                <button  type="submit" class="btn btn-success col-md-6 btn-lg float-right" name="btn_send" id="btn_send"><i class="fa fa-paper-plane"></i>&nbsp;SEND</button>
                              </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
</div>
  
<!--JavaScript Libraries-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/mdb.min.js"></script>
</body>
</html>

<?php
    session_start();
    include ('connection.php');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $user_pass = mysqli_real_escape_string($conn, $_POST['user_pass']);
        $user_conf_pass = htmlspecialchars($_POST['user_conf_pass']);

        //$check_user = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$user'");
        //$check_email = mysqli_query($conn, "SELECT * FROM users WHERE UserEmail = '$email'");
        $check_all = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$user' AND UserEmail = '$email'");
        $check_sql = mysqli_query($conn, "SELECT * FROM users");
        $check_row = mysqli_fetch_assoc($check_all);


        if ($user != $check_row['Username']) {
            echo "<script>
                alert('Username does not existing');
            </script>";

        } elseif ($email != $check_row['UserEmail']) {
            echo "<script>
                alert('Email does not existing');
            </script>";

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                alert('Email is not a valid address');
            </script>";
        } else {
            if ($check_all) {
                if ($user_pass != $user_conf_pass) {
                    echo "<script>
                        alert('Passwords does not match!!!');
                    </script>" ;
                }
                else {
                    $update = "UPDATE users SET UserPassword = '".htmlspecialchars($user_pass)."' WHERE Username = '$user' AND UserEmail = '$email'";
                    $update_res = mysqli_query($conn, $update);

                    if ($update_res) {
                        echo "<script>
                            alert('Your password has been changed succesfully');
                        </script>
                        <meta http-equiv='refresh' content='0 url='login.php?remarks=success'>";
                    } else {
                        echo "<script>
                            alert('Failure in updating password');
                        </script>";
                    }
                }
            }
            else {
                echo "<script>
                    alert('Username or Email does not match');
                </script>";
            }
        }
    }
    
?>