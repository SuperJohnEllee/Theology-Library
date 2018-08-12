<!DOCTYPE html>
<?php

	if (isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}
	include ('../connection.php');
	$req_sql = "SELECT book_requestID FROM book_request";
	$req_res = mysqli_query($conn, $req_sql);
	$res_count = mysqli_num_rows($req_res);
?>
<html>
<head>
	<meta content="College of Theology Library">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-4">
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
<div class="table-scrol">
		<h1 class="text-center"><i class="fa fa-book"></i>&nbsp;Requested Books(<?php echo htmlspecialchars($res_count); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3>List of Requested Books
				<hr class="theo-footer-hr">
				</h3>
				<br>
				<form class="form-horizontal" method="post">
					<div class="form-group col-lg-9">
						<div class="input-group">
							<input class="form-control" type="text" name="request_search" onkeyup="filterSearch()" id="request_search">
							<button class="btn btn-primary" name="btn_request_search"><span class="fa fa-search"></span> Search</button>
						</div>
					</div>
				</form>
				<table id="request_table" class="table table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col">Requested ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Author</th>
							<th scope="col">Edition</th>
							<th scope="col">Copyright</th>
							<th scope="col">Publication Date</th>
							<th scope="col">Publisher</th>
							<th scope="col">Name of User</th>
							<th scope="col">Requested Date</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
				<?php

				if (isset($_POST['btn_request_search'])) {
					$request_search = htmlspecialchars($_POST['request_search']);
					$request_search = mysqli_real_escape_string($conn, $request_search);

					$sql_search = "SELECT * FROM book_request
								WHERE book_requestID LIKE '%$request_search%'
								OR BookName LIKE '%$request_search%' 
								OR Author LIKE '%$request_search%'
								OR Edition LIKE '%$request_search%'  
								OR Copyright LIKE '%$request_search%' 
								OR Publisher LIKE '%$request_search%'
								OR FullName LIKE '%$request_search%'";

					$res_search = mysqli_query($conn, $sql_search);
					$count_search = mysqli_num_rows($res_search);

					if ($count_search > 0) {
						while ($row_search = mysqli_fetch_array($res_search)) {
							echo '<tr><td>'.$row_search['book_requestID'].'</td>';
							echo '<td>'.$row_search['BookName'].'</td>';
							echo '<td>'.$row_search['Author'].'</td>';
							echo '<td>'.$row_search['Edition'].'</td>';
							echo '<td>'.$row_search['Copyright'].'</td>';
							echo '<td>'.$row_search['Publisher'].'</td>';
							echo '<td>'.$row_search['Publish_Date'].'</td>';
							echo '<td>'.$row_search['FullName'].'</td>';
							echo '<td>'.$row_search['Request_Date'].'</td></tr>';
						}

						echo "<h3 class='alert alert-success text-center'>
    						<span class='fa fa-check'></span> ".$count_search." results found 
  							</h3";
					} else {
						echo "<h3 class='alert alert-danger text-center'>
						<span class='fa fa-close'></span> Keyword '$search' was not found
					</h3>";
					}

				} else {

					$view_Requested = "SELECT * FROM book_request ORDER BY Request_Date DESC ";
					$result = mysqli_query($conn, $view_Requested);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)){

					echo '<tr><td>'.$row['book_requestID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Edition'].'</td>';
					echo '<td>'.$row['Copyright'].'</td>';
					echo '<td>'.$row['Publisher'].'</td>';
					echo '<td>'.$row['Publish_Date'].'</td>';
					echo '<td>'.$row['FullName'].'</td>';
					echo '<td>'.$row['Request_Date'].'</td>';
					echo "<td><a class='btn btn-default'><span class='fa fa-check'></span> Approve</a></td>";
					echo "<td><a class='btn btn-danger'><span class='fa fa-close'></span> Deny</a></td></tr>";
				 	}
				 } else {
				 	echo "<div class='alert alert-warning alert-dismissible text-center'>
    					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    					<strong>Warning!</strong> No requested books found
  						</div>";
				 }
			}
				 ?>
				</table>
			</div>
		</div>
	</div>
	<script>
	function filterSearch() {
 	 var input, filter, table, tr, td, i, j;
  		input = document.getElementById("request_search");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("request_table");
  		tr = table.getElementsByTagName("tr");

  	for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[1];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[i].style.display = "";
      			} else {
        		tr[i].style.display = "none";
      		}
    	}       
  	}

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[7];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[j].style.display = "";
      			} else {
        		tr[j].style.display = "none";
      		}
    	}       
  	}
}



		function funcPrint() {
			window.print();
		}
	</script>
<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="js/mdb.min.js"></script>
</body>
</html>