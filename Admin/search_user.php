<?php

include ('../connection.php');

$search = $_GET['search'];
$sql = "SELECT * FROM users WHERE UserID LIKE('$search%')
			OR UserLName LIKE('$search%')
			OR UserFName LIKE('$search%')
			OR UserMName LIKE('$search%')
			OR UserEmail LIKE('$search%')
			OR UserContactNumber LIKE('$search%')
			OR Username LIKE('$search%') ";
$result = mysqli_query($conn, $sql);
while ($row = mysql_fetch_assoc($result)) {
	echo "<tr>
			<td>" echo $row['UserID']; "</td>
			<td>" echo $row['UserLName']; "</td>
			<td>" echo $row['UserFName']; "</td>
			<td>" echo $row['UserMName']; "</td>
			<td>" echo $row['UserEmail']; "</td>
			<td>" echo $row['UserContactNumber']; "</td>
			<td>" echo $row['Username']; "</td>
		</tr>";
}
?>