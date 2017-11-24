<?php
$dbc = mysqli_connect("localhost", "root", "", "register");

if(isset($_SESSION['userid'])) {
if(isset($_POST['mail']) && isset($_POST['password']) && $_POST['mail'] != "" && $_POST['password'] != "") {
	
	$mail = htmlspecialchars($_POST['mail']);
	$password = htmlspecialchars($_POST['password']);	

	$sql = mysqli_query($dbc, "SELECT * FROM users WHERE mail = '$mail' AND password = '$password'");

	$row = mysqli_fetch_array($sql);

	if($row != null) {
		echo "Successfully logged in!";
		$_SESSION['userid'] = $row['id'];
	} else {
		echo "Fel mail eller lösenord, försök vänligen <a href='login.php'>här</a> igen!";
	}
} else {	
	header("Location:login.php");
}

} else {
	echo "Du är redan inloggad!";
}
?>