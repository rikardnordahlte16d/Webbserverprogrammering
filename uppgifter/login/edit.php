<?php
session_start();
if(isset($_SESSION['username'])) {
	$dbc = mysqli_connect("localhost","root","","register");
	
	$data = mysqli_query($dbc, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "';");
	
	$row = mysqli_fetch_array($data);
	
	echo 'Edit user<br>
			<form method="POST" action="updateuser.php">
				Användarnamn: <input type="text" name="username" value="' . $row["username"] . '"><br/>
				Fullständigt namn: <input type="text" name="full_name" value="' . $row["full_name"] . '"><br/>
				Mail: <input type="text" name="mail" value="' . $row["mail"] . '"><br/>
				Födelsedatum: <input type="date" name="date" value="' . $row["date"] . '"><br/>
				Lösenord: <input type="password" name="password" value="' . $row["password"] . '"><br/>
				<input type="submit">
			</form>';
		
	
} else {
	header("Location:login.php");
}

?>