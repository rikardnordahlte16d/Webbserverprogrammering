
<?php

	$dbc = mysqli_connect("localhost","root","","register");
	
	if(!$dbc) {
		die("Connection failed..");
	} 

	$username = $_POST['username'];
	$full_name = $_POST['full_name'];
	$mail = $_POST['mail'];
	$date = $_POST['date'];
	$password = $_POST['password'];
	
	if(!mysqli_query($dbc, 'INSERT INTO users (username, full_name, mail, date, password) VALUES ("' . $username . '", "' . $full_name . '", "' . $mail . '", "' . $date . '", "' . $password . '")')) {
		echo mysqli_error($dbc);
	} else {
		echo "Registreringen lyckades!";
	}
	
?>