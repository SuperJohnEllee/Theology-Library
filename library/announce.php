<?php

$conn = mysqli_connect('localhost', 'root', '') or 
  die('Connection failed: ' . mysqli_error());

  mysqli_select_db($conn, 'theo_db') or 
  die('Cannot connected to the database: ' . mysqli_error());

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $body = mysqli_real_escape_string($conn, $_POST['body']);
  $post = $_POST['post'];

  if ($post) {
    if ($title && $body) {
      $insert = mysqli_query("INSERT INTO announcement(Title, Body) VALUES ('$title', '$body') ");
    }
    else{
      echo "<script> 
      alert('Please input all fields');
      </script>"; 
    }
  }

/*
  if (isset($_POST['post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $announce = mysqli_real_escape_string($conn, $_POST['announce']);

    $post_announce = "INSERT INTO(Title, Body) VALUES
    ('$title', '$announce');";

   if (mysqli_query($conn, $post_announce)) {
        $postTitle = $_SESSION['title'];
        $postAnnouncement = $_SESSION['announce'];
        header("location: ../index.php");
   }
   
  } */

?>