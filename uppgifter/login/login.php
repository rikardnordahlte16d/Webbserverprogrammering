<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
	</head>
	<body>
		<?php 
			session_start();
			if(!isset($_SESSION['username'])) {
				echo '
				<form method="POST" action="submit.php">
					Email: <input type="mail" style="margin-left:22px" name="mail"><br>
					Lösenord: <input type="password" name="password"><br>
					<input type="submit">
				</form>
				';
			} else {
				echo "Welcome <a href='edit.php'>" . $_SESSION['username'] . "</a>";
				echo '<br><a href="login.php?logout=1">Log out</a>';
				if(isset($_GET['logout'])) {
					session_destroy();
					header("Location:login.php");
				}
			}
		?>
	</body>
</html>