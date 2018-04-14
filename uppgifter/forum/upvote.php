<?php
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$id = $_GET['id'];
	$arg = $_GET['arg'];
	$query = mysqli_query($dbc, "SELECT * FROM posts WHERE id=" . $id . ";");
	if($arg == 1) {
		while($row = mysqli_fetch_array($query)) {
			$upvotes = $row['upvotes'];
			$upvotes--;
			mysqli_query($dbc, "UPDATE posts SET upvotes=" . $upvotes . " WHERE id=" . $id . ";");
			header("location:thread.php?id=" . $row['thread_id']);
		}
	} else if ($arg == 2) {
		while($row = mysqli_fetch_array($query)) {
			$upvotes = $row['upvotes'];
			$upvotes++;
			mysqli_query($dbc, "UPDATE posts SET upvotes=" . $upvotes . " WHERE id=" . $id . ";");
			header("location:thread.php?id=" . $row['thread_id']);
		}
	}
?>