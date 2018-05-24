<?php
include("banner.php");
$id = $_GET['id'];
$accept = $_GET['accept'];

if($accept == "true") {
	$result = mysqli_query($dbc, "SELECT * FROM friend_requests WHERE id=" . $id);
	$row = mysqli_fetch_array($result);
	mysqli_query($dbc, "INSERT INTO friends (user_one, user_two) VALUES ('" . $row['user_from_id'] . "','" . $row['user_to_id'] . "')");
	mysqli_query($dbc, "DELETE FROM friend_requests WHERE id=" . $id);
} else if ($accept == "false") {
	mysqli_query($dbc, "DELETE FROM friend_requests WHERE id=" . $id);
}

?>