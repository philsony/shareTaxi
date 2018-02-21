<?php
	session_start();
	$user = "root";
	$pass = "";
	$db = "shareTaxi";

	$db = mysqli_connect("localhost", $user, $pass, $db) or die("Failed to Load");
?>