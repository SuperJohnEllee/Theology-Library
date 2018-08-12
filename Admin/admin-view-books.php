<?php
	session_start();
	session_set_cookie_params(432000);
	$session_user = $_SESSION['admin_user'];
	if (!$session_user) {
		header("location: index.php");
	}

	include ('../connection.php');

	$sql = "SELECT BookID FROM theo_books";
	$res_sql = mysqli_query($conn, $sql); 
	$book_count = mysqli_num_rows($res_sql); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>College of Theology - View Book Information</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler cyan lighten-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br>
	<div class="table-scrol"><br>
		<h1 class="text-center"><i class="fa fa-book"></i>&nbsp;Book Information(<?php echo $book_count; ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3><span class="fa fa-remark"></span>&nbsp;List of Books 
				<hr class="theo-footer-hr">
				<a class="btn btn-primary" href="admin-create-books.php"><span class="fa fa-plus"></span>&nbsp;Add Books</a>
				<!--<a style="float: right;" class="btn btn-primary" href="admin-book-search.php"><span class="fa fa-search"></span>&nbsp;Search Books</a> -->
				</h3>
				<br>
			</div>
			<form action="admin-view-books.php" method="post">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="search" id="myInput" onkeyup="myFunction()" name="book_search" placeholder="Search">
							<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span>&nbsp;Search</button>
					</div>
				</div>
			</form>
			<h5>Search for Call Number</h5>
				<table class="table table-hover" id="myTable">
					<thead class="thead-inverse">
						<tr>
							<th colspan="1">Book Image</th>
							<th colspan="1">Book ID</th>
							<th colspan="1">ISBN</th>
							<th colspan="1">Call Number</th>
							<th colspan="1">Book Name</th>
							<th colspan="1">Book Subtitle</th>
							<th colspan="1">Author</th>
							<th colspan="1">Edition</th>
							<th colspan="1">Publisher</th>
							<th colspan="1">Copyright</th>
							<th colspan="2">Date Posted</th>
							<th colspan="2">Action</th>
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
						echo '<td>'.$row['BookCopyright'].'</td>';
						echo '<td>'.$row['BookPostDate'].'</td>';
						echo '<td><a class="btn btn-info" href="admin-edit-books.php?id='.$row['BookID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
						echo '<td><a class="btn btn-danger" href="admin-delete.php?del='.$row['BookID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				}

				echo "<h3 class='alert alert-success text-center'>
    						<span class='fa fa-check'></span> ".$count." results found 
  							</h3";
			
			} else {
				echo "<h3 class='alert alert-danger text-center'>
						<span class='fa fa-close'></span> Keyword '$search' was not found
					</h3>";
			}
		} else  {

					$viewBooks = "SELECT * FROM theo_books ORDER BY BookPostDate DESC";
					$result = mysqli_query($conn, $viewBooks);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)) {

					echo '<tr><td><img src="../book_image/'.$row['BookImage'].'"style="width:150px;height:200px;"</td>';
					echo '<td>'.$row['BookID'].'</td>';
					echo'<td>'.$row['ISBN'].'</td>';
					echo '<td>'.$row['BookCallNumber'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['BookType'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['BookEdition'].'</td>';
					echo '<td>'.$row['BookPublisher'].'</td>';
					echo '<td>'.$row['BookCopyright'].'</td>';
					echo '<td>'.$row['BookPostDate'].'</td>';
					echo '<td><a class="btn btn-info" href="admin-edit-books.php?edit='.$row['BookID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
					echo '<td><a class="btn btn-danger" href="admin-delete.php?del='.$row['BookID'].'"><span class="fa fa-trash"></span> Delete</a></td>
					</tr>';
				 	}
				 } else {
				 	echo "<h3 class='text-center'><span></span> No Books Found</h3>";
				 }
			}
				 ?>
				</table>
		</div>
	</div>
<script>
	function myFunction() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[4];//Book Name
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[j].style.display = "";
      			} else {
        		tr[j].style.display = "none";
      		}
    	}       
  	}

  	for (k = 0; k < tr.length; k++) {
    		td = tr[k].getElementsByTagName("td")[3]; //Call Number
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[k].style.display = "";
      			} else {
        		tr[k].style.display = "none";
      		}
    	}       
  	}
}
</script>
<!-- JavaScript Libraries -->
<script src="../js/bootstrap.js"></script>
<script src="..js/jquery.js"></script>
<script src="../js/mdb.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>