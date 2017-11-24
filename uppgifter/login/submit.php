<?php
$dbc = mysqli_connect("localhost", "root", "", "register");

$mail = $_POST['mail'];
$password = $_POST['password'];	

$sql = mysqli_query($dbc, "SELECT * FROM users WHERE mail = '$mail' AND password = '$password'");

?>