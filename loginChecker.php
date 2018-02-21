<?php
	session_start();

	if(!session_check(['id', 'login_user']) && strpos($_SERVER["REQUEST_URI"],"login.php") === false && strpos($_SERVER["REQUEST_URI"],"register.php") === false ) {
		header("Location: ../login/login.php");
	}

 $user_id = $_SESSION['id'] ;
 $login_session = $_SESSION['login_user'] ;
?>
