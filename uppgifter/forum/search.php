<?php
include("banner.php");

$query = $_GET['query'];
if($query != "") {
	echo "<h3>Resultat för: " . $query . "</h3>";

	$user_query = mysqli_query($dbc, "SELECT * FROM users WHERE username LIKE '%" . $query . "%'");
	while($user_row = mysqli_fetch_array($user_query)) {
		echo "<a href='profile.php?id=" . $user_row['id'] . "'>" . $user_row['username'] . "</a> (användare) <br>";
	}

	$thread_query = mysqli_query($dbc, "SELECT * FROM threads WHERE name LIKE '%" . $query . "%'");
	while($thread_row = mysqli_fetch_array($thread_query)) {
		$forumThread_query = mysqli_query($dbc, "SELECT * FROM forums WHERE id=" . $thread_row['forum_id']);
		$forumThread_row = mysqli_fetch_array($forumThread_query);
		echo "<a href='thread.php?id=" . $thread_row['id'] . "'>" . $thread_row['name'] . "</a> (tråd i forumet [<a href='forum.php?id=" . $forumThread_row ['id'] . "'>" . $forumThread_row['name'] . "</a>])<br>";
	}

	$forum_query = mysqli_query($dbc, "SELECT * FROM forums WHERE name LIKE '%" . $query . "%'");
	while($forum_row = mysqli_fetch_array($forum_query)) {
		echo "<a href='forum.php?id=" . $forum_row['id'] . "'>" . $forum_row['name'] . "</a> (forum)<br>";
	}
}

?>