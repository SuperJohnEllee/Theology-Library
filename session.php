<?php
    session_start();
    session_set_cookie_params(432000);
    $session_id = htmlspecialchars($_SESSION['userid']);
    $session_user = htmlspecialchars($_SESSION['username']);
    $session_firstname = htmlspecialchars($_SESSION['firstname']);
    $session_midname = htmlspecialchars($_SESSION['midname']);
    $session_lastname = htmlspecialchars($_SESSION['lastname']);
    $session_email = htmlspecialchars($_SESSION['email']);
    $session_contact_num = htmlspecialchars($_SESSION['contact_num']);
    $session_gender = htmlspecialchars($_SESSION['gender']);
    $session_birthday = htmlspecialchars($_SESSION['birthday']);
    $session_type = htmlspecialchars($_SESSION['type']);
    $session_name = htmlspecialchars($session_firstname) . " " .  htmlspecialchars($session_lastname);
    $session_fullname = htmlspecialchars($session_firstname) . " ".  htmlspecialchars($session_midname) . " " . htmlspecialchars($session_lastname);

        if (!$session_user) {
            header('location: 404_page.php');
    }
?>