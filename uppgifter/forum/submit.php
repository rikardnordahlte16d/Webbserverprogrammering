<?php

	$dbc = mysqli_connect("localhost","root","","forum");
	
	if(!$dbc) {
		die("Connection failed..");
	} 

	$username = $_POST['username'];
	$name = $_POST['name'];
	$mail = $_POST['mail'];
	$birthday = $_POST['birthday'];
	$password = $_POST['password'];
	
	if(!mysqli_query($dbc, 'INSERT INTO users (username, name, password, mail, birthday) VALUES ("' . $username . '", "' . $name . '", "' . $password . '", "' . $mail . '", "' . $birthday . '")')) {
		echo mysqli_error($dbc);
	} else {
		echo "Registreringen lyckades!";
	}
	
?>