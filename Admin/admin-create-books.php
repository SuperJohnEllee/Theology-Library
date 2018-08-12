<?php
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_name = htmlspecialchars($_SESSION['name']);
	if (!$session_admin_user) {
		header("location: index.php");
	}
/* Connection */
include ('../connection.php');

	$add_sql = "SELECT BookID FROM theo_books";
	$add_res = mysqli_query($conn, $add_sql);
	$add_count = mysqli_num_rows($add_res);
?>

<!DOCTYPE html>
<html> 
<head>
	<meta content="College of Theology Library">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>College of Theology Library - Create Books</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-3">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
			</div>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="row main">
			<div class="text-dark ml-5">
				<h1 class="text-center">Upload a Book</h1>
				<h4 class="text-center">You uploaded <?php echo htmlspecialchars($add_count); ?> books</h4>
				<br>
					<form class="form-horizontal" method="post" action="admin-create-books.php" enctype="multipart/form-data">
					<div class="row">	
						<div class="form-group col-md-6">
							<label for="call_number" class="cols-sm-2 control-label">Book Image</label>
							<div class="cols-sm-10">
									<input type="file" class="form-control" name="image" id="image" placeholder="Book Image" required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="call_number" class="cols-sm-2 control-label">Call Number</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="call_number" id="call_number" placeholder="Call Number" required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="isbn" class="cols-sm-2 control-label">ISBN</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="isbn" id="isbn"  placeholder="ISBN" required />
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="email" class="cols-sm-2 control-label">Book Title</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="book_title" id="book_title"  placeholder="Book Title" required />
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="username" class="cols-sm-2 control-label">Subtitle</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="book_subtitle" id="book_subtitle" placeholder="Book Title" required />
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="author" class="cols-sm-2 control-label">Author</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="author" id="author"  placeholder="Author Name" required />
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="edition" class="cols-sm-2 control-label">Edition</label>
							<div class="cols-sm-10">
									<input class="form-control" type="text" name="edition" id="edition" placeholder="Edition Type" required>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="publisher" class="cols-sm-2 control-label">Publisher</label>
							<div class="cols-sm-10">
									<input class="form-control" type="text" name="publisher" id="publisher" placeholder="Enter Publisher" required>
							</div>
						</div>
							<div class="form-group col-md-6">
								<label for="copyright" class="cols-sm-2 control-label">Copyright</label>
								<div class="cols-sm-10">
										<input class="form-control" type="text" name="copyright" id="copyright" placeholder="Enter Copyright" required>
								</div>
							</div>
						<div class="form-group col-md-6">
							<button class="btn green accent-4 btn-lg" name="btn_add" id="btn_add"><i class="fa fa-paper-plane icon"></i>&nbsp;Post Books</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	<footer style="padding: 15px 0;" class="fixed-bottom mdb-color darken-4 text-center text-white">
		<h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
	</footer>
<?php

$time = time();
if (isset($_POST['btn_add'])) {

		$isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
		$call_number = mysqli_real_escape_string($conn, $_POST['call_number']);
		$book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
		$book_subtitle = mysqli_real_escape_string($conn, $_POST['book_subtitle']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$edition = mysqli_real_escape_string($conn, $_POST['edition']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$book_image = mysqli_real_escape_string($conn, 
			'../book_image/'.$_FILES['image']['name']);

		if (preg_match("!image!", $_FILES['image']['type'])) {
				if (copy($_FILES['image']['tmp_name'], $book_image)) {

					$check_isbn = mysqli_query($conn, "SELECT * FROM theo_books WHERE ISBN = '$isbn'");
					$check_callnum = mysqli_query($conn, "SELECT * FROM theo_books WHERE BookCallNumber = '$call_number'");

					if (mysqli_num_rows($check_isbn) > 0) {
						echo "<script>
							alert('ISBN is already existing');
						</script>";
					} else if (mysqli_num_rows($check_callnum) > 0) {
						echo "<script>
							alert('Call Number is already existing');
						</script>";
					} else {

						$sql = "INSERT INTO theo_books(ISBN, BookName, BookType, Author, BookCallNumber, BookImage,BookEdition, BookPublisher, BookCopyright, BookPostDate) ". 
						"VALUES('$isbn', '$book_title', 
						'$book_subtitle', '$author', 
						'$call_number', '$book_image', 
						'$edition', '$publisher', '$copyright', NOW())";

						if (mysqli_query($conn, $sql)) {

							echo "<script>
							alert('Success: Successfully added a book');
							</script>
							<meta http-equiv='refresh' content='0; url=admin-create-books.php'>";	
							//Added Book Logs
                 			$filename = "../system/added_books.txt";
                 			$fp = fopen($filename, 'a+');
                 			fwrite($fp, " " . $session_admin_user . " added a book " . $book_title . " | " . date("l jS \of F Y h:i:s A", $time). "\n");
                 		fclose($fp);
                 		die();
						} else {
							echo "<script>
								alert('Error: Failure in book submission');
							</script>";
						}
					}
				} else {
						echo "<script>
							alert('Error: Image upload failed');
						</script>";
					}	
				} else {
					echo "<script>
						alert('Error: Invalid type of file');
					</script>";
			}
		}
?>
<!-- JavaScript Libraries -->
	<script src="../js/bootstrap.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/mdb.min.js"></script>
</body>
</html>