<?php
	session_start();
	$session_user = $_SESSION['admin_user'];
	if (!$session_user) {
			header('location: index.php');
		}

	include ('../connection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body>
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler text-white grey darken-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br>
	<div class="container"><br>
		<div class="page-header">
			<h3>Search Books</h3>
			<hr class="theo-footer-hr">
			<a class="btn btn-primary" href="admin-view-books.php"><span class="fa fa-arrow-left"></span>&nbsp;Go Back</a>
		</div>
		<div class="row">
			<div class="col-md-7">
				<h5 class="text-center">Enter Book Details</h5>
				<fieldset>
					<form action="admin-book-search.php" method="post">
						<div class="form-group">
							<div id="search_area" class="input-group">
								<input class="form-control" type="text" name="book_search" id="book_search">
								<button type="submit" class="btn btn-default" name="btn_search"><span class="fa fa-search"></span>&nbsp;Search</button>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
		<table class="table table-hover">
			<thead class="thead-inverse">
				<tr>
					<th>Book Image</th>
					<th>Book ID</th>
					<th>ISBN</th>
					<th>Book CallNumber</th>
					<th>Book Name</th>
					<th>Book Subtitle</th>
					<th>Author</th>
					<th>Publisher</th>
					<th>Edition</th>
					<th>Copyright</th>
				</tr>
			</thead>
<?php
	if (isset($_POST['btn_search'])) {

		$search = mysqli_real_escape_string($conn, $_POST['book_search']);
		$sql = "SELECT * FROM theo_books 
			WHERE BookID LIKE '%$search%' 
			OR ISBN LIKE '%$search%'
			OR BookCallNumber LIKE '%$search%'
			OR BookName LIKE '%$search%'
			OR BookType LIKE '%$search%'
			OR Author LIKE '%$search%'
			OR BookEdition LIKE '%$search%'
			OR BookPublisher LIKE '%$search%'
			OR BookCopyright LIKE '%$search%'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);

			if ($count > 0) {
				
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<tr><td><img src="../book_image/'.$row['BookImage'].'"style="width:150px;height:200px;"</td>';
					echo '<td>'.$row['BookID'].'</td>';
					echo '<td>'.$row['ISBN'].'</td>';
					echo '<td>'.$row['BookCallNumber'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['BookType'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['BookEdition'].'</td>';
					echo '<td>'.$row['BookPublisher'].'</td>';
					echo '<td>'.$row['BookCopyright'].'</td></tr>';
				}

				echo "<h3 class='text-center'>".$count." results found</h3>";
			
			} else {
				echo "<h3 class='text-center'><span class='fa fa-close'></span> Keyword $search was not found</h3>";
			}
		}
?>
</table>
</div>
<!--JavaScript Libraries-->
	
<script src="../js/bootstrap.js"></script>
<script src="..js/jquery.js"></script>
<script src="..js/mdb.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
</body>
</html>