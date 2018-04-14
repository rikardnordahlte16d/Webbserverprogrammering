<?php
include("banner.php");

$id = $_GET['id'];
$query = mysqli_query($dbc, "SELECT * FROM users WHERE id=" . $id);

while($row = mysqli_fetch_array($query)) {
	echo "<h4>" . $row['name'] . " (" . $row['username'] . ")</h4><hr width='20%' align='left'>";
	
	$thread_query = mysqli_query($dbc, "SELECT * FROM threads WHERE user_id=" . $id);
	echo "<h4>Skapade trådar:</h4>";
	while($thread_row = mysqli_fetch_array($thread_query)) {
		echo '<a href="thread.php?id=' . $thread_row['id'] . '">' . $thread_row['name'] . '</a><br>';
	}
	
	$comment_query = mysqli_query($dbc, "SELECT * FROM posts WHERE user_id=" . $id . " ORDER BY post_date DESC");
	echo "<h4>Kommentarer:</h4>";
	while($comment_row = mysqli_fetch_array($comment_query)) {
		$comment_thread_query = mysqli_query($dbc, "SELECT * FROM threads WHERE id=" . $comment_row['thread_id']);
		$comment_thread_row = mysqli_fetch_array($comment_thread_query);
		echo $row['username'] . ' kommenterade <a href="thread.php?id=' . $comment_row['thread_id'] . '">' . $comment_row['text'] . '</a> i <a href="thread.php?id=' . $comment_row['thread_id'] . '">' . $comment_thread_row['name'] . '</a>';
		if($row['id'] == $comment_thread_row['user_id']) echo " (OP)";
		echo '<br>';
	}
}

?>