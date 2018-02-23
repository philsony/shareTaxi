<?php
include("functions.php");
include("core.php");
include("loginChecker.php");

//phpmyadmin url : http://vps162337.vps.ovh.ca/phpmyadmin/
$user = "admin_shareTaxi";
$pass = "shareTaxi";
$db = "admin_shareTaxi";

$db = mysqli_connect("144.217.5.247", $user, $pass, $db) or die("Failed to Load");
$conn = $db ;
$userLocation = getUserLocation();

?>
