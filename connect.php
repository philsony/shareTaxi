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

if(strpos($_SERVER["REQUEST_URI"],"updateLocation") === false){
?>
<<<<<<< HEAD
=======
<!-- To be removed  start -->
<a href="<?php echo BASE_URL ; ?>login/welcome.php"><h2 style="text-align: center;">Menu</h2></a>
<!-- To be removed  end -->
>>>>>>> da52d3f8d44faff150c7da6e726997a343f31182
<?php }
