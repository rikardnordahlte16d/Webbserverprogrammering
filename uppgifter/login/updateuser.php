<?php
$dbc = mysqli_connect("localhost", "root", "", "register");
session_start();

if(isset($_POST['username']) && isset($_POST['full_name']) && isset($_POST['mail']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['username'] != "" && $_POST['full_name'] != "" && $_POST['mail'] != "" && $_POST['password']  != "" && isset($_SESSION['username'])) {
	$username = $_POST['username'];
	$full_name = $_POST['full_name'];
	$mail = $_POST['mail'];
	$date = $_POST['date'];
	$password = $_POST['password'];
	
	if(!mysqli_query($dbc, "UPDATE users SET username = '$username', full_name = '$full_name', mail = '$mail', date = '$date', password = '$password' WHERE username = '" . $_SESSION['username'] . "';")) {
		echo mysqli_error($dbc);
	} else {
		unset($_SESSION['username']);
		$_SESSION['username'] = $username;
		echo "Changes saved!";
		echo "<br><a href='login.php'>Home</a>";
	}
	
} else {	
	header("Location:login.php");
}
?>