<?php
$dbc = mysqli_connect("localhost", "root", "", "forum");

session_start();

if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "" && !isset($_SESSION['username'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);	

	$sql = mysqli_query($dbc, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

	$row = mysqli_fetch_array($sql);

	if($row != null) {
		$_SESSION['username'] = $row['username'];
		$_SESSION['id'] = $row['id'];
		header("location:index.php");
	} else {
		header("location:index.php?password=1&username=" . $username);
	}
} else {	
	header("location:index.php?loggedin=1");
}
?>