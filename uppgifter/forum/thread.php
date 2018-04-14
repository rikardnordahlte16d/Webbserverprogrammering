<?php
	include("banner.php");

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
	<?php
	if(isset($_SESSION['username'])) {
	?>
		<textarea cols="50" rows="10" name="text"></textarea>
	<?php
	} else {
	?>
		<textarea cols="50" rows="10" name="text" style="display:inline" disabled></textarea>
		<br><p style="display:inline; margin:none;">Du måste <a href="#" onclick="showLogin()">logga in</a> för att skriva kommentarer!</p><br>
	<?php
	}
	?><br>
	<input type="submit" class="menuButton" value="Comment!"/>
</form>
<br>
<?php
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$query = mysqli_query($dbc, "SELECT * FROM posts WHERE thread_id=" . $_GET['id'] . " ORDER BY upvotes DESC, post_date DESC");
	while($row = mysqli_fetch_array($query)) {
		$user_query = mysqli_query($dbc, "SELECT username FROM users WHERE id=" . $row['user_id']);
		$user_result = mysqli_fetch_array($user_query);
		
		$date = "";
		$post_date = explode(" ", $row['post_date']);
		if($post_date[0] == date("Y-m-d")) {
			$time_args = explode(":", $post_date[1]);
			//H:i:s
			if($time_args[0] == date("H")) {
				if($time_args[1] == date ("i")) {
					$date = date("s") - $time_args[2] . " sekunder sen";
				} else {
					$minut = date("i") - $time_args[1];
					if($minut == 1) $date = $minut . " minut sen"; else $date = $minut . " minuter sen";
				}
			}
		} else {
			$day_args = explode("-", $post_date[0]);
			if($day_args[1] == date("m") && $day_args[0] == date("Y")) {
				
				$days = date("d") - $day_args[2];
				if($days == 1) $date =  $days . " dag sen"; else $date = $days . " dagar sen";
				
			} else if ($day_args[1] != date("m") && $day_args[0] == date("Y")) {
				$months = date("m") - $day_args[1];
				if($months == 1) $date =  $months . " månad sen"; else $date = $months . " månader sedan";
			} else {
				$years = date("Y") - $day_args[0];
				$date =  $years . " år sen"; 
			}
		}
		
		
		echo "<a href='profile.php?id=" . $row['user_id'] . "'>" . $user_result['username'] . "</a>: (" . $date . ")<br>";
		echo $row['text'];
		echo "<br>";
		echo "<a href='upvote.php?id=" . $row['id'] . "&arg=1'>-</a> ";
		echo "(" . $row['upvotes'] . ")";
		echo " <a href='upvote.php?id=" . $row['id'] . "&arg=2'>+</a> ";
		echo "<br>";
		echo "<hr width='25%' align='left'>";
	}
?>