<?php
include("banner.php");
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$birthday = $_POST['birthday'];
		$password = $_POST['password'];
		
		if(!mysqli_query($dbc, 'INSERT INTO users (username, name, password, mail, birthday) VALUES ("' . $username . '", "' . $name . '", "' . $password . '", "' . $mail . '", "' . $birthday . '")')) {
			echo mysqli_error($dbc);
		} else {
			header("location:index.php");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form method="POST" action="register.php" id="register" autocomplete="off">
			Användarnamn: <input type="text" name="username"><br/>
			Fullständigt namn: <input type="text" name="name"><br/>
			Mail: <input type="text" name="mail"><br/>
			Födelsedatum: <input type="date" name="birthday" style="font-size: 1.16em"><br/>
			Lösenord: <input type="password" name="password"><br/>
			<input type="submit" class="menuButton" value="Registrera dig!"/>	
		</form>
	</body>
</html>