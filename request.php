<?php
	include ('session.php');
	$session_firstname = htmlspecialchars($_SESSION['firstname']);
    $session_midname = htmlspecialchars($_SESSION['midname']);
    $session_lastname = htmlspecialchars($_SESSION['lastname']);
    $session_id = htmlspecialchars($_SESSION['userid']);

?>

<!DOCTYPE html>
<html>
<head>
	<meta content="College of Theology Library">
	<meta name="viewport" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0" charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
</head>
<body class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#">
			<img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
		<button class="navbar-toggler teal lighten-3" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto"> 
				<li class="nav-item">
					<a class="nav-link text-white" href="home.php"><span class="fa fa-home"></span><span class="sr-only">(current)</span> Home</a>
				</li>
			</ul>
		</div>
	</nav><br><br><br>
	<div class="text-center">
		<h2>College of Theology Library</h2>
		<h3>University Libraries</h3>
		<h4>Iloilo City, Philippines</h4>
	</div>
	<br>
	<div class="container">
		<h5>Library Purchase Request</h5>
		<p>Note: You can only request 3 books per week</p>
		<hr class="divider">
		<h3><?php echo htmlspecialchars($session_name); ?></h3>
		<br>
		<form class="form-horizontal" role="form" action="request.php" method="post" enctype="multipart/form-data">
			<div class="form-row">	
				<div class="form-group col-md-6">
					<label class="control-label col-sm-4" for="book_name">Book Title:</label>
						<div class="col-sm-8">
								<input class="form-control" type="text" name="book_name" required>
						</div>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-sm-4" for="author">Author<small>(if known):</small></label>
						<div class="col-sm-8">
								<input class="form-control" type="text" name="author" required>
						</div>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-sm-4" for="edition">Edition<small>(optional)</small> </label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="edition">
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-sm-4" for="copyright">Copyright<small>(optional)</small> </label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="copyright">
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-sm-4" for="publisher">Publisher<small>(optional)</small> </label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="publisher">
					</div>
				</div>

				<div class="form-group col-md-6">
					<label class="control-label col-sm-4" for="publish_date">Publication Date<small>(optional)</small> </label>
					<div class="col-sm-8">
						<input class="form-control" type="date" name="publish_date">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-2">
						<button class="btn btn-primary btn-lg" type="submit" name="btn_request"><i class="fa fa-chevron-circle-right"></i>&nbsp;Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>
<!--JavaScript Libraries-->
  	<script src="js/bootstrap.js"></script>
  	<script src="js/jquery.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/popper.min.js"></script>
  	<script src="js/mdb.min.js"></script>
<?php
	include ('connection.php');

	if (isset($_POST['btn_request'])) {
		$book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$edition = mysqli_real_escape_string($conn, $_POST['edition']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
		$publish_date = mysqli_real_escape_string($conn, $_POST['publish_date']);
		
		$fullname = htmlspecialchars($session_firstname) . ' ' . htmlspecialchars($session_midname) . ' ' . htmlspecialchars($session_lastname);

		$check_bookname = mysqli_query($conn, "SELECT * FROM book_request WHERE BookName = '$book_name'");
		$bookname_count = mysqli_num_rows($check_bookname);

		/**$request_sql = mysqli_query($conn, "SELECT COUNT('$book_name') FROM book_request WHERE FullName = '$fullname'");
		$request_count = mysqli_num_rows($request_sql);

		if ($request_count) {
			echo "<script>
				alert('You have $request_count request left');
			</script>"; 
		} **/
		
		if ($bookname_count > 0) {
			echo "<script>
				alert('Your requested book is already existing');
			</script>";
		} else {	
			$sql = "INSERT INTO book_request
				(UsersID, BookName, Author, Edition, Copyright, Publish_Date, Publisher, FullName, Request_Date)
				VALUES('$session_id', '$book_name', '$author','$edition', '$copyright', 
				'$publisher', '$publish_date', '$fullname' , NOW())";

				if (mysqli_query($conn, $sql)) {
					
					echo "<script>
							alert('Success: Successfully requested a book');
						</script>";

					//Added Requested Book Logs
						$time = time();
                 		$filename = "system/requested_books.txt";
                 		$fp = fopen($filename, 'a+');
                 			fwrite($fp, " " . $session_user . " requested a book " . $book_name . " | " . date("l jS \of F Y h:i:s A", $time). "\n");
                 		fclose($fp);
                 		die();
				} else {
					echo "<script>
							alert('Failure in requesting a book');
						</script>";
					}
					mysqli_close($conn);
 				}
 			}
?>
</body>
</html>