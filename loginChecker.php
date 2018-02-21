<?php
	require "functions.php";
	
	
	session_start();

	if(!session_check(['id', 'login_user'])) {
		header("Location: ../login/login.php");
	} 
?>