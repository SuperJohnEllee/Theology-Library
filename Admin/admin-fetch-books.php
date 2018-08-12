<?php
	
	if (isset($_POST["query"])) {
	
		include ('../connection.php');
		$book_search = mysqli_real_escape_string($conn, $_POST["query"]);
		$sql = "SELECT * FROM theo_books WHERE
	BookName LIKE '%".$book_search."%'
	OR BookType LIKE '%".$book_search."%' 
	OR ISBN LIKE '%".$book_search."%'
	OR BookCallNumber LIKE '%".$book_search."%'
	OR Author LIKE '%".$book_search."%'
	OR BookEdition LIKE '%".$book_search."%'
	OR BookCopyright LIKE '%".$book_search."%'
	OR BookPublisher LIKE '%".$book_search."%'
	";
	$result = mysqli_query($conn, $sql);
		$html = '';
		$data = array();	
		$html .= '
				<table class="table table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col">Book Image</th>
							<th scope="col">Book ID</th>
							<th scope="col">ISBN</th>
							<th scope="col">Call Number</th>
							<th scope="col">Book Name</th>
							<th scope="col">Book Subtitle</th>
							<th scope="col">Author</th>
							<th scope="col">Edition</th>
							<th scope="col">Publisher</th>
							<th scope="col">Copyright</th>
						</tr>';
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row["BookName"];
				$data[] = $row["BookType"];
				$data[] = $row["ISBN"];
				$data[] = $row["BookCallNumber"];
				$data[] = $row["Author"];
				$data[] = $row["BookEdition"];
				$data[] = $row["BookCopyright"];
				$data[] = $row["BookPublisher"];
				$html .= '<tr>
					<td><img src="../book_image/'.$row['BookImage'].'</td>
					<td>'.$row['BookID'].'</td>
					<td>'.$row['ISBN'].'</td>
					<td>'.$row['BookCallNumber'].'</td>
					<td>'.$row['BookName'].'</td>
					<td>'.$row['BookType'].'</td>
					<td>'.$row['Author'].'</td>
					<td>'.$row['BookEdition'].'</td>
					<td>'.$row['BookPublisher'].'</td>
					<td>'.$row['BookCopyright'].'</td>
				</tr>';
			}
			$html .= '</table>'; //closing
			if (isset($_POST["typehead_search"])) {	
				echo $html;
			} else {
				$data = array_unique($data);
				echo json_encode($data);
			}
	}
?>