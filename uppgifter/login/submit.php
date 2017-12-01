<?php
$dbc = mysqli_connect("localhost", "root", "", "register");
session_start();

if(isset($_POST['mail']) && isset($_POST['password']) && $_POST['mail'] != "" && $_POST['password'] != "" && !isset($_SESSION['username'])) {
	$mail = htmlspecialchars($_POST['mail']);
	$password = htmlspecialchars($_POST['password']);	

	$sql = mysqli_query($dbc, "SELECT * FROM users WHERE mail = '$mail' AND password = '$password'");

	$row = mysqli_fetch_array($sql);

	if($row != null) {
		$_SESSION['username'] = $row['username'];
		header("Location:login.php");
	} else {
		echo "Fel mail eller lösenord, försök vänligen <a href='login.php'>här</a> igen!";
	}
} else {	
	header("Location:login.php");
}
?>