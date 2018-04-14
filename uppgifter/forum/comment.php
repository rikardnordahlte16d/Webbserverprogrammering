<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$text = htmlspecialchars($_POST['text']);
	mysqli_query($dbc, "INSERT INTO posts (thread_id, user_id, text, upvotes) VALUES ('" . $_GET['id'] . "','" . $_SESSION['id'] . "','" . $text . "',0);");
	header("location:thread.php?id=" . $_GET['id']);
?>