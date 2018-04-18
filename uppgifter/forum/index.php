<?php
include("banner.php");

?>
<link rel="stylesheet" href="css/index.css"/>
<?php if($logged_in) {?><a href="addforum.php"><span id="plus">+</span></a><?php } ?>

<table>
<?php

	$sql = mysqli_query($dbc, "SELECT * FROM forums");

	while($row = mysqli_fetch_array($sql)) {
		$result = mysqli_query($dbc, "SELECT id,username FROM users WHERE id=" . $row['user_id'] . ";");
		$user_row = mysqli_fetch_array($result);
		?>
		<tr><td width="70%"><a href="forum.php?id=<?php echo $row['id'] ?>" class="link" title="<?php echo $row['name']; ?>"><p class="forum_name"><?php echo $row['name']; ?></p></a></td><td><a href="profile.php?id=<?php echo $user_row['id'] ?>" class="link"><p id="forum_creator"><?php echo $user_row['username'];?></p></a></td></tr>
		<?php
	}	
?>
</table>
<hr>
<center><h4>Nya trådar</h4></center>
<table>
<?php

	$sql = mysqli_query($dbc, "SELECT * FROM threads ORDER BY thread_date DESC");

	while($row = mysqli_fetch_array($sql)) {
		$result = mysqli_query($dbc, "SELECT id,username FROM users WHERE id=" . $row['user_id'] . ";");
		$user_row = mysqli_fetch_array($result);
		$forum_result = mysqli_query($dbc, "SELECT name,id FROM forums WHERE id=" . $row['forum_id']);
		$forum_row = mysqli_fetch_array($forum_result);
		?>
		<tr><td width="50%"><a href="thread.php?id=<?php echo $row['id'] ?>" class="link" title="<?php echo $row['name']; ?>"><p class="forum_name"><?php echo $row['name']; ?></p></a></td><td><a href="forum.php?id=<?php echo $forum_row['id']; ?>" class="link"><p id="forum_creator"><?php echo $forum_row['name'];?></p></a></td><td><a href="profile.php?id=<?php echo $user_row['id'] ?>" class="link"><p id="forum_creator"><?php echo $user_row['username'];?></p></a></td></tr>
		<?php
	}	
?>
</table>
