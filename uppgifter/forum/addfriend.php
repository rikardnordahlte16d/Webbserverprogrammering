<?php
include("banner.php");
$id = $_GET['id'];

if($logged_in && $id != $_SESSION['id']) {
	$check_result = mysqli_query($dbc, "SELECT * FROM friend_requests WHERE user_from_id='" . $_SESSION['id'] . "' AND user_to_id='" . $id . "'");
	$check_row = mysqli_fetch_array($check_result);
	if($check_row != null) { header("location:profile.php?id=" . $id); return; }
	mysqli_query($dbc, "INSERT INTO friend_requests (user_from_id, user_to_id) VALUES (" . $_SESSION['id'] . "," . $id . ");");
	header("location:profile.php?id=" . $id);
} else {
	header("location:profile.php?id=" . $id);
}

?>