<?php
    require "connect.php";
	
	$srcAddr = $_POST['source'];
	$srcLat	= floatval($_POST['srcLat']);
	$srcLong = floatval($_POST['srcLong']);
	$destAddr = $_POST['destination'];
	$destLat = floatval($_POST['destLat']);
	$destLong = floatval($_POST['destLong']);
	$userID = $_POST['ID'];
	
	// Look for userID in pool
	$query = "SELECT * FROM pool WHERE user_id = $userID";
	$result = mysqli_query($db, $query) or die("Error $query");
	// Get route_id
	$row = mysqli_fetch_assoc($result);
	$routeID = $row['route_id'];
	// Update route based on route_id
	$query = "UPDATE route SET origin_address = '$srcAddr', origin_latitude= $srcLat, origin_longitude= $srcLong, destination_address = '$destAddr', destination_latitude=$destLat, destination_longitude=$destLong, status='Waiting', cost=0  WHERE route_id = $routeID";
	$result = mysqli_query($db, $query) or die("Error $query");
	
	echo "Successful";
?>