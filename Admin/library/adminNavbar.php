<?php
  $admin = false;
  $username = '';
  $dashboard = '';
  if (isset($_SESSION['admin_user']) and isset($_SESSION['type'])) {
      
      $admin = true;
      $username = htmlspecialchars($_SESSION['username']);

      switch ($_SESSION['type']) {
        case 'Admin':
          $dashboard = 'adminHome.php';
          break;

        case 'Librarian':
          $dashboard = 'theology-dashboard.php';
          break;
        case 'Secretary':
          
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
                    
      }
  }
?>