<?php
	session_start();

	if(!session_check(['id', 'login_user']) && strpos($_SERVER["REQUEST_URI"],"login.php") === false && strpos($_SERVER["REQUEST_URI"],"register.php") === false ) {
		header(LOGIN_URL);
	}

	if(session_check(['id', 'login_user']) && (strpos($_SERVER["REQUEST_URI"],"login.php") !== false || strpos($_SERVER["REQUEST_URI"],"register.php") !== false || strpos($_SERVER["REQUEST_URI"],"connect.php") !== false)){
   header(WELCOME_URL);
	}

	$userId = (isset($_SESSION['id'] )) ?  $_SESSION['id']: '' ;
	$loginSession = (isset($_SESSION['login_user'] )) ? $_SESSION['login_user'] : '';


