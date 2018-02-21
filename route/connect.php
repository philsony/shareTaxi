<<<<<<< HEAD
<?php
	session_start();
	$_SESSION['id'] = 1; // temporary variable, actual variable with at login module
	$user = "root";
	$pass = "";
	$db = "sharetaxi-route";

	$db = mysqli_connect("localhost", $user, $pass, $db) or die("Failed to Load");
?>
=======
<?php
	session_start();
	$user = "root";
	$pass = "";
	$db = "shareTaxi";

	$db = mysqli_connect("localhost", $user, $pass, $db) or die("Failed to Load");
?>
>>>>>>> 433af9c52ccd5fa8649a8d7de447871ae1df4675
