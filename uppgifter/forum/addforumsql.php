<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$name = $_POST["name"];
	$id = $_SESSION['id'];
	mysqli_query($dbc, 'INSERT INTO forums (user_id, name) VALUES ("' . $id . '","'. $name . '")');
	header("location:index.php");
?>