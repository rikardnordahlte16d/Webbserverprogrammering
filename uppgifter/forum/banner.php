<!DOCTYPE html>
<html>
	<head>
		<title>PWO Addicts</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/banner.css">
	</head>
	<body>
		<a href="index.php" style="text-decoration:none;"><h3 id="logo">&nbspPWO Addicts&nbsp</h3></a>
		<div id="login">
			<div id="login_buttons">
				<a href="register.php"><button class="menuButton">Registrera dig</button></a>
				<a href="#"><button onclick="showLogin()" class="menuButton">Logga in</button></a>
			</div>
			
			<form method="POST" action="login.php" autocomplete="off" id="loginField" style="display:none;">
				<div id="login_field" style="display:none">
					Användarnamn: <input type="text" name="username" id="username"/><br/>
					Lösenord: <input type="password" name="password" id="password"/><br/>
					<input type="submit" value="Logga in!" id="login_button" class="menuButton"><br/>
					<input type="checkbox"/> Kom ihåg mig &nbsp&nbsp&nbsp<a href="resetpassword.php">Glömt lösenordet?</a>
				</div>
			</form>
		</div>
		<?php
		session_start();
		if(isset($_SESSION['username'])) {
		?>
				<script>
						login_field = document.getElementById("login_buttons");
						login_field.style.display = "none";
				</script>
				<?php
				echo '<a href="index.php?logout=1" class="link" id="logout">Logga ut</a>';
				echo '<a href="profile.php?id=' . $_SESSION['id'] . '" class="link" id="profile">' . $_SESSION['username'] . '</a>';
				if(isset($_GET['logout'])) {
					session_destroy();
					header("Location:index.php");
				}
		}
		?>
		
		<hr>
		
		<?php
			if(isset($_GET['password'])) {
				echo "<p id='wrong_password'>Fel användarnamn eller lösenord, vänligen försök igen.</p>";
				?>
				<script>
					login_field = document.getElementById("login_field").style.display = "inline";
					document.getElementById("username").value = "<?php echo $_GET['username']; ?>";
					document.getElementById("password").focus();
				</script>
				<?php
			}
		?>
		
		<script>
			function showLogin() {
				login_field = document.getElementById("login_field");
				if(login_field.style.display == "none") {
					login_field.style.display = "inline";
					document.getElementById("username").focus();
					document.getElementById("loginField").style.display = "table";
					
				} else if (login_field.style.display == "inline") {
					login_field.style.display = "none";
					document.getElementById("loginField").style.display = "none";
				}
			}
		</script>
		
	</body>
</html>