<?php
$dbc = mysqli_connect("localhost", "root", "", "register");

if(isset($_POST['mail']) && isset($_POST['password'])) {
	
	$mail = htmlspecialchars($_POST['mail']);
	$password = htmlspecialchars($_POST['password']);	

	$sql = mysqli_query($dbc, "SELECT * FROM users WHERE mail = '$mail' AND password = '$password'");

	$row = mysqli_fetch_array($sql);

	if($row != null) {
		echo "Successfully logged in!";
	} else {
		echo "Fel mail eller lösenord, försök vänligen <a href='login.php'>här</a> igen!";
	}
} else {	
	header("Location:login.php");
}

?>