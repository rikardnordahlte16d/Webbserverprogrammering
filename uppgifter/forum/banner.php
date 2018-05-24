<?php
session_start();
$dbc = mysqli_connect("localhost", "root", "", "forum");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PWO Addicts</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/banner.css">
	</head>
	<body>
		<a href="index.php" style="text-decoration:none;"><h3 id="logo">&nbspPWO Addicts&nbsp</h3></a> <a href="about.php"><img width="20" src="images/questionmark.png"></a>
		<form action="search.php" method="GET" style="position:absolute; margin-top:-30px; margin-left:680px;" autocomplete="off"><input type="text" name="query"><button class="menuButton">Sök</button></form>
		<div id="login">
			<div id="login_buttons">
				<a href="register.php"><button class="menuButton">Registrera dig</button></a>
				<a href="#"><button onclick="showLogin()" class="menuButton">Logga in</button></a>
			</div>
			
			<form method="POST" action="login.php" autocomplete="off" id="loginField" style="display:none;">
				<div id="login_field" style="display:none">
					Användarnamn: <input type="text" name="username" id="username"/><br/>
					Lösenord: <input type="password" name="password" id="password"/><br/>
					
					<input type="text" value="<?php echo "$_SERVER[REQUEST_URI]"; ?>" name="url" style="display:none"> <!-- Länk till hemsidan man var på innan inloggning -->
					
					<input type="submit" value="Logga in!" id="login_button" class="menuButton"><br/>
					<input type="checkbox"/> Kom ihåg mig &nbsp&nbsp&nbsp<a href="resetpassword.php">Glömt lösenordet?</a>
				</div>
			</form>
				<div id="notification_field" style="display:none;" onmouseleave="showNotifications();">
				<?php
					$result = mysqli_query($dbc, "SELECT * FROM friend_requests WHERE user_to_id=" . $_SESSION['id'] . " ORDER BY id DESC ");
					while($row = mysqli_fetch_array($result)) {
						
						$user_result = mysqli_query($dbc, "SELECT * FROM users WHERE id=" . $row['user_from_id']);
						$user_row = mysqli_fetch_array($user_result);
						echo "<a href='profile.php?id=" . $user_row['id'] . "'>" . $user_row['username'] . "</a> lade till dig som vän. <a href='friendrequest.php?id=" . $row['id'] . "&accept=true'>Bekräfta</a>&nbsp&nbsp&nbsp<a href='friendrequest.php?id=" . $row['id'] . "&accept=false'>Avböj</a>";
						echo "<hr>";
					}
					
					$result = mysqli_query($dbc, "SELECT * FROM notifications WHERE user_to_id=" . $_SESSION['id'] . " ORDER BY id DESC");
					while($row = mysqli_fetch_array($result)) {
						
						$user_result = mysqli_query($dbc, "SELECT * FROM users WHERE id=" . $row['user_from_id']);
						$user_row = mysqli_fetch_array($user_result);
						
						$thread_result = mysqli_query($dbc, "SELECT * FROM threads WHERE id=" . $row['thread_id']);
						$thread_row = mysqli_fetch_array($thread_result);
						
						if(substr($row['text'], 0, 2) != "@@" && strlen($row['text']) > 15) {
							$row['text'] = substr($row['text'], 0, 15) . "...";
						} else if (substr($row['text'], 0, 2) == "@@" && strlen($row['text']) > 15 + strlen($_SESSION['username'])) {
							$row['text'] = substr($row['text'], 0, strlen($_SESSION['username']) + 19) . "...";
						}
						
						if(strlen($thread_row['name']) > 15) {
							$thread_row['name'] = substr($thread_row['name'], 0, 15) . "...";
						}
						
						$duplication = 0; //Annars får man dubletter notiser om man har en tråd och nån taggar nån i den
						
						if(substr($row['text'], 0, 2) != "@@") {
							echo "<a href='profile.php?id=" . $user_row['id'] . "'>" . $user_row['username'] . "</a> kommentera &#34;" . $row['text'] . "&#34; i din tråd <a onclick='deleteNotification(" . $row['id'] . ");' href='thread.php?id=" . $thread_row['id'] . "'>" . $thread_row['name'] . "</a><br>"; 
							$duplication = 1;
						} else {
							if($duplication == 0) $row['text'] = substr($row['text'], strlen($_SESSION['username'])+2);echo "<a href='profile.php?id=" . $user_row['id'] . "'>" . $user_row['username'] . "</a> taggade dig i en kommentar &#34;" . substr($row['text'], 1) . "&#34; i tråden <a href='thread.php?id=" . $thread_row['id'] . "'>" . $thread_row['name'] . "</a><br>";
						}
						echo "<hr>";
					}
				?>
				</div>
		</div>
		<?php
		if(isset($_SESSION['username'])) {
		?>
				<script>
						login_field = document.getElementById("login_buttons");
						login_field.style.display = "none";
				</script>
				<?php
				echo '<a href="index.php?logout=1" class="link" id="logout">Logga ut</a>';
				
				$result = mysqli_query($dbc, "SELECT count(user_to_id) FROM notifications WHERE user_to_id=" . $_SESSION['id']);
				$row = mysqli_fetch_array($result);
				$result_frequests = mysqli_query($dbc, "SELECT count(user_to_id) FROM friend_requests WHERE user_to_id=" . $_SESSION['id']);
				$result_frequests_row = mysqli_fetch_array($result_frequests);
				$notifications = "(" . ($row[0] + $result_frequests_row[0])  . ")"; 
				
				if($notifications != "(0)") echo '<span onmouseover="showNotifications();" class="link" id="notifications_link">' . $notifications . '</span>';
				echo '<a href="profile.php?id=' . $_SESSION['id'] . '" class="link" id="profile">' . $_SESSION['username'] . '</a>';
				
				if(isset($_GET['logout'])) {
					session_destroy();
					header("Location:index.php");
				}
		}
		?>
		
		<hr>
		
		<?php
			if(isset($_GET['password']) && !isset($_SESSION['username'])) {
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
					document.getElementById("loginField").style.display = "table";
					document.getElementById("username").focus();
				} else if (login_field.style.display == "inline") {
					login_field.style.display = "none";
					document.getElementById("loginField").style.display = "none";
				}
			}
			function showNotifications() {
				notification_field = document.getElementById("notification_field");
				if(notification_field.style.display == "none") {
					notification_field.style.display = "inline";
				} else if (notification_field.style.display == "inline") {
					notification_field.style.display = "none";
				}
			}
			function deleteNotification(id) {
				alert(id);
			}
		</script>
		<?php
			$logged_in = isset($_SESSION['username']);
		?>
	</body>
</html>