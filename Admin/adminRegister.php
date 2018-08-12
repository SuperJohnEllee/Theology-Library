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
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_pass = $_POST['confirm_pass'];

        $check_user = "SELECT * FROM admin WHERE AdminUser = '$username'";
        $run_com = mysqli_query($conn, $check_user);

        if (mysqli_num_rows($run_com) > 0) {
            echo "<script>
                alert('Username already exist');
                </script>";
        }

        /**if ($password <= 6) {
            echo "<script>
                alert('Password must be 6 letters or more');
                </script>";
        } **/

        if ($password != $confirm_pass) {
            echo "<script>
                alert('Password do not match, try again');
            </script>";
        }

        $insert_com = "INSERT INTO admin(AdminLName, AdminFName, AdminMName, AdminUser, AdminPass) VALUES
            ('$lastname', '$firstname', '$midname', '$username',
             '$password');";

        if (mysqli_query($conn, $insert_com)) {
            echo "<script>
                window.open('index.php', '_self');
                </script>";
        }
    }
?>