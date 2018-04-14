<?php
include("banner.php");

if(!isset($_SESSION['username'])) {
	return;
}
?>
<link rel="stylesheet" href="css/index.css"/>
<a href="addforum.php"><span id="plus">+</span></a>

<table>
<?php
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	mysqli_query($dbc, "SET NAMES utf8");

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
