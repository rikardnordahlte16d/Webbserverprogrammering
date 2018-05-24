<?php
include("banner.php");

if(isset($_POST['username'])) { //Kollar om $_POST['username'] existerar (finns bara om man har klickat på ändra knappen)
	$username = $_POST['username'];
	$name = $_POST['name'];
	$mail = $_POST['mail'];
	$birthday = $_POST['birthday'];
	$password = $_POST['password'];
mysqli_query($dbc, "UPDATE users SET username='" . $username . "', name='" . $name . "', mail='" . $mail . "', birthday='" . $birthday . "', password='" . $password . "' WHERE id=" . $_SESSION['id']);
	$_SESSION['username'] = $username;
}
if(isset($_GET['action'])) {
	echo "<script>alert('Ändringarna sparades');</script>";
}

if(!$logged_in) header("location:index.php");
$user = mysqli_query($dbc, "SELECT * FROM users WHERE id=" . $_SESSION['id']);
$user_row = mysqli_fetch_array($user);
echo
	'<center><h2>Ändra profil</h2></center>
	<form method="POST" action="editprofile.php?action=1" id="register" autocomplete="off">
		Användarnamn: <input type="text" name="username" value="'. $user_row['username'] . '"><br/>
		Fullständigt namn: <input type="text" name="name" value="'. $user_row['name'] . '"><br/>
		Mail: <input type="text" name="mail" value="'. $user_row['mail'] . '"><br/>
		Födelsedatum: <input type="date" name="birthday" style="font-size: 1.16em" value="'. $user_row['birthday'] . '"><br/>
		Lösenord: <input type="password" name="password" value="'. $user_row['password'] . '"><br/>
		<input type="submit" class="menuButton" value="Ändra"/>	
	 </form>';
?>
