<?php
$dbc = mysqli_connect("localhost", "root", "", "register");
session_start();

if(isset($_POST['username']) && isset($_POST['full_name']) && isset($_POST['mail']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['username'] != "" && $_POST['full_name'] != "" && $_POST['mail'] != "" && $_POST['password']  != "" && isset($_SESSION['username'])) {
	
} else {	
	header("Location:login.php");
}
?>