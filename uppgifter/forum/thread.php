<?php

	include("banner.php");
	if(!isset($_SESSION['username'])) {
		return;
	}

	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$query = mysqli_query($dbc, "SELECT * FROM threads WHERE id=" . $_GET['id']);
	while($row = mysqli_fetch_array($query)) {
		$user_query = mysqli_query($dbc, "SELECT username FROM users WHERE id=" . $row['user_id']);
		$user_result = mysqli_fetch_array($user_query);
		$forum_query = mysqli_query($dbc, "SELECT * FROM forums WHERE id=" . $row['forum_id']);
		$forum_result = mysqli_fetch_array($forum_query);
		echo "inlagd av <a href='profile.php?id=" . $row['user_id'] . "'>" . $user_result['username'] . "</a> i <a href='forum.php?id=" . $row['forum_id'] . "'>" . $forum_result['name'] . "</a><br><br>";
		echo $row['name'];
		echo "<br>";
		echo $row['text'];
	}
?>
<h3>Comment:</h3>
<form method="POST" action="comment.php?id=<?php echo $_GET['id']; ?>">
	<textarea cols="50" rows="10" name="text"></textarea><br>
	<input type="submit" class="menuButton" value="Comment!"/>
</form>
<br>
<?php
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$query = mysqli_query($dbc, "SELECT * FROM posts WHERE thread_id=" . $_GET['id']);
	while($row = mysqli_fetch_array($query)) {
		$user_query = mysqli_query($dbc, "SELECT username FROM users WHERE id=" . $row['user_id']);
		$user_result = mysqli_fetch_array($user_query);
		echo "<a href='profile.php?id=" . $row['user_id'] . "'>" . $user_result['username'] . "</a>:<br>";
		echo $row['text'];
		echo "<br>";
		echo "<a href='upvote.php?id=" . $row['id'] . "&arg=1'>-</a> ";
		echo "(" . $row['upvotes'] . ")";
		echo " <a href='upvote.php?id=" . $row['id'] . "&arg=2'>+</a> ";
		echo "<br>";
		echo "<hr width='25%' align='left'>";
	}
?>