<?php
include("banner.php");

$id = $_GET['id'];
$query = mysqli_query($dbc, "SELECT * FROM users WHERE id=" . $id);

while($row = mysqli_fetch_array($query)) {
	echo $row['name'] . " (" . $row['username'] . ")";
}

?>