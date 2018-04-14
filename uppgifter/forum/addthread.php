<?php
include("banner.php");
if(!isset($_SESSION['username'])) {
	return;
}
?>
<html>
	<body>
		<center>
			<form method="POST" action="addthreadsql.php?id=<?php echo $_GET['id']; ?>" autocomplete="off">
				Tråd namn<br><input type="text"/ name="name"><br/>
				Tråd text<br><textarea rows="10" cols="100" name="text"></textarea><br/>
				<input type="submit" class="menuButton" value="Lägg till!"/>
			</form>
		</center>
	</body>
</html>