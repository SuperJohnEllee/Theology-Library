<?php
  	if (!isset($_SESSION['username'])) {
		{
	}
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top mdb-color darken-4">
    <a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="Logo" height="30" width="30" style="display: inline-block;"></a>
      <button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="personnel.php"><i class="fa fa-users"></i>&nbsp;Faculty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="courses.php"><i class="fa fa-graduation-cap"></i>&nbsp;Courses</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="about.php"><i class="fa fa-info-circle"></i>&nbsp;Brief History</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="news.php"><i class="fa fa-bullhorn"></i>&nbsp;Annoucement</a>
      </li>
        <li class="nav-item">
        <a class="nav-link text-white" href="Register.php"><i class="fa fa-user-plus"></i>&nbsp;Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
      </li>
    </ul>
  </div>
</nav>
<?php
}
else {
?>
<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
    <a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="Logo" height="30" width="30" style="display: inline-block;"></a>
      <button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="reservation.php"><i class="fa fa-bookmark"></i>&nbsp;Reservation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="request.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>"><i class="fa fa-bookmark"></i>&nbsp;Request</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="news.php"><i class="fa fa-bullhorn"></i>&nbsp;Annoucement</a>
      </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="profile.php?<?php echo htmlspecialchars($_SESSION['username']);?>"><span class="fa fa-user"></span>&nbsp;<?php echo htmlspecialchars($_SESSION['username'])?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
      </li>
    </ul>
  </div>
</nav>
<?php
}
?>