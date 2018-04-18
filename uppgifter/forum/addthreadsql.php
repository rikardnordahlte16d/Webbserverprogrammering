<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$name = $_POST["name"];
	$text = $_POST['text'];
	$id = $_SESSION['id'];
	$forum_id = $_GET['id'];
	$thread_date = date("Y-m-d H:i:s");
	mysqli_query($dbc, "INSERT INTO threads (forum_id, user_id, name, text, thread_date) VALUES ('" . $forum_id . "','" . $id . "','" . $name . "','" . $text .  "','" . $thread_date . "')");
	header("location:forum.php?id=" . $forum_id);
?>