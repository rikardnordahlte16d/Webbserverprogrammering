<?php
include("banner.php");
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form method="POST" action="submit.php" id="register" autocomplete="off">
			Användarnamn: <input type="text" name="username"><br/>
			Fullständigt namn: <input type="text" name="name"><br/>
			Mail: <input type="text" name="mail"><br/>
			Födelsedatum: <input type="date" name="birthday"><br/>
			Lösenord: <input type="password" name="password"><br/>
			<input type="submit" class="menuButton" value="Registrera dig!"/>	
		</form>
	</body>
</html>