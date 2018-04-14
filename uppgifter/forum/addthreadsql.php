<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$name = $_POST["name"];
	$text = $_POST['text'];
	$id = $_SESSION['id'];
	$forum_id = $_GET['id'];
	mysqli_query($dbc, 'INSERT INTO threads (forum_id, user_id, name, text) VALUES ("' . $forum_id . '","'. $id . '","' . $name . '","' . $text . '")');
	header("location:forum.php?id=" . $forum_id);
?>