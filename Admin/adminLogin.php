<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "") or 
    die("Connection failed: " . mysqli_error());

    mysqli_select_db($conn, "theo_db") or
    die("Cannot connect to database: " . mysqli_error());

    if (isset($_POST['login'])) {
        //variables
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user_check = "SELECT * FROM admin WHERE AdminUser 
        = '$username' AND AdminPass = '$password'";
        $result = mysqli_query($conn, $user_check);

        mysqli_close($conn);

        if (mysqli_num_rows($result)) {
            echo "<script>
      window.open('adminHome.php', '_self');
                </script>";
            $_SESSION['username'] = $username;
        } else{
            echo "<script>
                    alert('Wrong username or password');
                </script>";
        }
    }
?>