<?php
  require('../connect.php');
	session_start();
   $_SESSION['id'] = 1 ;
   $_SESSION['login_user'] = 'login_user' ;

	if(!session_check(['id', 'login_user']) && strpos($_SERVER["REQUEST_URI"],"login.php") === false && strpos($_SERVER["REQUEST_URI"],"register.php") === false ) {
		header("Location: ../login/login.php");
	} else if (strpos($_SERVER["REQUEST_URI"],"testmarket") == false){
		header("Location: ../market/testmarket.php");
	}
?>
