<?php
  require('../connect.php');

	$srcAddr = addslashes($_POST['source']);
	$srcLat	= floatval($_POST['srcLat']);
	$srcLong = floatval($_POST['srcLong']);
	$destAddr = addslashes($_POST['destination']);
	$destLat = floatval($_POST['destLat']);
	$destLong = floatval($_POST['destLong']);
	$userID = $_POST['ID'];
  $return = 'Location: '.BASE_URL.'login/welcome.php?action=updated&entity=Route';

	// Look for userID in pool
	$query = "SELECT * FROM pool WHERE user_id = $userID";
	$result = mysqli_query($db, $query) or die("Error $query");
	// Get route_id
	$row = mysqli_fetch_assoc($result);
	$routeId = $row['route_id'];
	// Update route based on route_id
	$query = "UPDATE route SET origin_address = '$srcAddr', origin_latitude= $srcLat, origin_longitude= $srcLong, destination_address = '$destAddr', destination_latitude=$destLat, destination_longitude=$destLong, status='Waiting', cost=0  WHERE route_id = $routeId";
	$result = mysqli_query($db, $query) or die("Error $query");

	header($return);
?>
