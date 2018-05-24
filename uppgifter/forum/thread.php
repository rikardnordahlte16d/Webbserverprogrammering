<?php
	include("banner.php");

	$query = mysqli_query($dbc, "SELECT * FROM threads WHERE id=" . $_GET['id']);
	while($row = mysqli_fetch_array($query)) {
		$user_query = mysqli_query($dbc, "SELECT username FROM users WHERE id=" . $row['user_id']);
		$user_result = mysqli_fetch_array($user_query);
		$forum_query = mysqli_query($dbc, "SELECT * FROM forums WHERE id=" . $row['forum_id']);
		$forum_result = mysqli_fetch_array($forum_query);
		
		echo "inlagd av <a href='profile.php?id=" . $row['user_id'] . "'>" . $user_result['username'] . "</a> i <a href='forum.php?id=" . $row['forum_id'] . "'>" . $forum_result['name'] . "</a><br>";
		echo "<hr width='25%' align='left'>";
		echo $row['name'];
		echo "<br>";
		echo $row['text'];
	}
?>
<h3>Kommentera: </h3>
<form method="POST" action="comment.php?id=<?php echo $_GET['id']; ?>">
	<?php
	if(isset($_SESSION['username'])) {
	?>
		<textarea cols="50" rows="10" name="text"></textarea>
	<?php
	} else {
	?>
		<textarea cols="50" rows="10" name="text" style="resize:none" disabled></textarea>
		<br>Du måste <a href="#" onclick="showLogin()">logga in</a> för att skriva kommentarer!<br>
	<?php
	}
	?><br>
	<input type="submit" class="menuButton" value="Kommentera!"/> 
<?php 
$comment_count_query = mysqli_query($dbc, "SELECT count(id) FROM posts WHERE thread_id=" . $_GET['id']);
$comment_count_result = mysqli_fetch_array($comment_count_query);
echo " (" . $comment_count_result[0] . " kommentarerer)";
?>
</form>
<br>

<?php	
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$query = mysqli_query($dbc, "SELECT * FROM posts WHERE thread_id=" . $_GET['id'] . " ORDER BY upvotes DESC, post_date DESC");
	while($row = mysqli_fetch_array($query)) {
		$user_query = mysqli_query($dbc, "SELECT username,id FROM users WHERE id=" . $row['user_id']);
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
			} else {
				$hours = date("H") - $time_args[0];
				if($hours == 1) $date = $hours . " timme sen"; else $date = $hours . " timmar sen";
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
		if(isset($_GET['comment_id']) && $_GET['comment_id'] == $row['id']) {
			echo "<div style='background-color:rgba(0,0,0,0.1); width:25%; padding:1.5em;border:1px solid black;'>";
			echo "<a href='profile.php?id=" . $row['user_id'] . "'>" . $user_result['username'] . "</a>: (" . $date . ")<br>";
		} else {
			echo "<a href='profile.php?id=" . $row['user_id'] . "'>" . $user_result['username'] . "</a>: (" . $date . ")<br>";
		}
		
		echo $row['text'];
			echo "<br>";
			if(isset($_SESSION['username'])) {
				echo "<a href='upvote.php?id=" . $row['id'] . "&arg=1'>-</a> ";
				echo "(" . $row['upvotes'] . ")";
				echo " <a href='upvote.php?id=" . $row['id'] . "&arg=2'>+</a> ";
			} else {
				echo "<a href='#' onclick='showLogin()'>-</a> ";
				echo "(" . $row['upvotes'] . ")";
				echo " <a href='#' onclick='showLogin()'>+</a> ";
			}
			echo "<br>";
			echo "<hr width='25%' align='left'>";
			echo "</div>";
	
	}
?>