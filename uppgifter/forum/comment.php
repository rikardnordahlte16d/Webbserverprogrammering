<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$text = htmlspecialchars($_POST['text']);
	if($text != "") {
		$post_date = date("Y-m-d H:i:s");
		mysqli_query($dbc, "INSERT INTO posts (thread_id, user_id, text, upvotes, post_date) VALUES ('" . $_GET['id'] . "','" . $_SESSION['id'] . "','" . $text . "',0,'" . $post_date . "')");
	}	
	header("location:thread.php?id=" . $_GET['id']);
?>