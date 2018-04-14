<?php
	include("banner.php");
?>
<link rel="stylesheet" href="css/index.css"/>
<a href="<?php echo 'addthread.php?id=' . $_GET["id"]; ?>"><span id="plus">+</span></a>
<table>
<?php
	$id = $_GET['id'];
	$result = mysqli_query($dbc, "SELECT * FROM threads WHERE forum_id=" . $id . ";");


	$forum_result = mysqli_query($dbc, "SELECT * FROM forums WHERE id='" . $id . "';");
	$forum_row = mysqli_fetch_array($forum_result);

	echo "<center><span id='forum_name'>" . $forum_row['name'] . "</span></center><hr width='50%'><br>";
	while($row = mysqli_fetch_array($result)) {
		$user_result = mysqli_query($dbc, "SELECT id,username FROM users WHERE id=" . $row['user_id'] . ";");
		$user_row = mysqli_fetch_array($user_result);
		?>
		<tr><td width="70%"><a href="<?php echo 'thread.php?id=' . $row['id']; ?>" class="link" title="<?php echo $row['name']; ?>"><p class="forum_name"><?php echo $row['name']; ?></p></a></td><td><a href='profile.php?id=<?php echo $row['user_id']; ?>' class="link"><p id="forum_creator"><?php echo $user_row['username'];?></p></a></td></tr>
		<?php
	}	
?>
</table>
