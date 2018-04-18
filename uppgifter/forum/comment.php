<?php
	session_start();
	$dbc = mysqli_connect("localhost", "root", "", "forum");
	$text = htmlspecialchars($_POST['text']);
	if($text != "") {
		$post_date = date("Y-m-d H:i:s");
		mysqli_query($dbc, "INSERT INTO posts (thread_id, user_id, text, upvotes, post_date) VALUES ('" . $_GET['id'] . "','" . $_SESSION['id'] . "','" . $text . "',0,'" . $post_date . "')");
		
		$result = mysqli_query($dbc, "SELECT user_id FROM threads WHERE id=" . $_GET['id']);
		$row = mysqli_fetch_array($result);
		
		if($row['user_id'] != $_SESSION['id']) mysqli_query($dbc, "INSERT INTO notifications (text, user_from_id, user_to_id, thread_id) VALUES ('" . $text . "','" . $_SESSION['id'] . "','" . $row['user_id'] . "','" . $_GET['id'] . "')");
		
		if(strpos($text, "@") == 0) { //Tagga användare
			$username = substr(explode(" " , $text)[0], 1);
			$user_result = mysqli_query($dbc, "SELECT * FROM users WHERE username='" . $username . "'");
			
			$user_row = mysqli_fetch_array($user_result);
			
			if($user_row && $user_row['id'] != $_SESSION['id']) { //Användaren existerar
				mysqli_query($dbc, "INSERT INTO notifications (text, user_from_id, user_to_id, thread_id) VALUES ('@" . $text . "','" . $_SESSION['id'] . "','" . $user_row['id'] . "','" . $_GET['id'] . "')");
			}
		}
	}
	header("location:thread.php?id=" . $_GET['id']);
?>