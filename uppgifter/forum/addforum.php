<?php
include("banner.php");
if(!isset($_SESSION['username'])) {
	return;
}
?>
<html>
	<body>
		<center>
			<form method="POST" action="addforumsql.php" autocomplete="off">
				Forum namn: <input type="text"/ name="name"><br/><br/>
				<input type="submit" class="menuButton" value="Lägg till!"/>
			</form>
		</center>
	</body>
</html>