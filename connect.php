<?php
include("functions.php");

$user = "admin_shareTaxi";
$pass = "shareTaxi";
$db = "admin_shareTaxi";

$db = mysqli_connect("144.217.5.247", $user, $pass, $db) or die("Failed to Load");

$userLocation = getUserLocation();  


?>
