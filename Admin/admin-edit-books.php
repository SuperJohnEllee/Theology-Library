<!DOCTYPE html>
<?php
	include ('../connection.php');

	$id = htmlspecialchars($_GET['edit']);
	$sql = "SELECT * FROM theo_books WHERE BookID = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$row_image = '../book_image/'. htmlspecialchars($row['BookImage']);
?>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler teal lighten-3" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="adminHome.php"><span class="fa fa-home"></span><span class="sr-only">(current)</span> Home</a>
				</li>
			</ul>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h3><i class="fa fa-edit"></i>&nbsp;Edit Books</h3>
			<hr class="theo-footer-hr">
		</div><br>
		<div class="col-md-7">
			<form class="form-horizontal row" action="admin-edit-books.php" method="post" enctype="multipart/form-data">
					<div class="cols-sm-10">
							<input type="hidden" class="form-control" name="id" id="id" placeholder="ID" required>
					</div>
					<div class="form-group col-lg-6">
							<label for="call_number" class="cols-sm-2 control-label">Book Image</label>
							<img height="250" width="250" src="<?php echo htmlspecialchars($row_image); ?>">
							<div class="cols-sm-10">
									<input type="file" class="form-control" name="image" id="image" placeholder="Book Image" required>
							</div>
					</div>
						<div class="form-group col-lg-7">
							<label for="call_number" class="cols-sm-2 control-label">Call Number</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="call_number" id="call_number" value="<?php echo htmlspecialchars($row['BookCallNumber']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="isbn" class="cols-sm-2 control-label">ISBN</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="isbn" id="isbn" value="<?php echo htmlspecialchars($row['ISBN']); ?>">
							</div>
						</div>
						<div class="form-group col-lg-10">
							<label for="email" class="cols-sm-2 control-label">Book Title</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="book_title" id="book_title"  placeholder="Book Title" value="<?php echo htmlspecialchars($row['BookName']); ?>">
							</div>
						</div>

						<div class="form-group col-lg-10">
							<label for="username" class="cols-sm-2 control-label">Subtitle</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="book_subtitle" id="book_subtitle" 
									value="<?php echo htmlspecialchars($row['BookType']); ?>">
							</div>
						</div>

						<div class="form-group col-lg-6">
							<label for="author" class="cols-sm-2 control-label">Author</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="author" id="author" value="<?php echo htmlspecialchars($row['Author']); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="edition" class="cols-sm-2 control-label">Edition</label>
							<div class="cols-sm-10">
									<input class="form-control" type="text" name="edition" id="edition" placeholder="Edition Type" value="<?php echo htmlspecialchars($row['BookEdition']) ?>">
							</div>
						</div>
						<div class="form-group col-lg-6">
							<label for="publisher" class="cols-sm-2 control-label">Publisher</label>
							<div class="cols-sm-10">
									<input class="form-control" type="text" name="publisher" id="publisher" placeholder="Enter Publisher" value="<?php echo htmlspecialchars($row['BookPublisher']); ?>">
							</div>
						</div>
							<div class="form-group col-lg-6">
								<label for="copyright" class="cols-sm-2 control-label">Copyright</label>
								<div class="cols-sm-10">
										<input class="form-control" type="text" name="copyright" id="copyright" placeholder="Enter Copyright" value="<?php echo htmlspecialchars($row['BookCopyright']); ?>">
								</div>
							</div>
						<div class="form-group col-lg-6">
							<button class="btn btn-primary btn-lg" name="btn_add" id="btn_add"><i class="fa fa-download icon"></i>&nbsp;Save</button>
						</div>
			</form>
		</div>
	</div>

<!-- JavaScript Libraries -->
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.6/js/mdb.min.js"></script>
</body>
</html>