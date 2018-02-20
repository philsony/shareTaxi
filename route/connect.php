<?php
	session_start();
	$_SESSION['id'] = 1; // temporary variable, actual variable with at login module
	$user = "root";
	$pass = "";
	$db = "sharetaxi-route";

	$db = mysqli_connect("localhost", $user, $pass, $db) or die("Failed to Load");
?>
