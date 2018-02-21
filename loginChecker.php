<?php
	session_start();

	if(!session_check(['id', 'login_user']) && strpos($_SERVER["REQUEST_URI"],"login.php") === false && strpos($_SERVER["REQUEST_URI"],"register.php") === false ) {
		header("Location: ../login/login.php");

	} else if (strpos($_SERVER["REQUEST_URI"],"testmarket") === false && strpos($_SERVER["REQUEST_URI"],"login.php") === false && strpos($_SERVER["REQUEST_URI"],"register.php") === false ){
		header("Location: ../market/testmarket.php");

	}
?>
