<?php
  require('../connect.php');


	// Redirects unauthorized/unintentional access
	if( !isset($_POST['destLat']) || !isset($_POST['destLong']) ) {
		header('location:create_src.php');
	}
	require "../core.php";


	// Redirects unauthorized/unintentional access
	if( !isset($_POST['destLat']) || !isset($_POST['destLong']) ) {
		header(CREATE_SOURCE);
		die("Unauthorized access");
	}

	$srcAddr = $_POST['source'];
	$srcLat	= floatval($_POST['srcLat']);
	$srcLong = floatval($_POST['srcLong']);

	$destAddr = $_POST['destination'];
	$destLat = floatval($_POST['destLat']);
	$destLong = floatval($_POST['destLong']);


	// Confirms creation of route to prevent duplicates lol feel free to change, thessa~*
	$query = "SELECT * FROM route WHERE origin_latitude = {$srcLat} AND origin_longitude = {$srcLong} AND destination_latitude = {$destLat} AND destination_longitude = {$destLong} AND route_status = 'Waiting'";
	$result = mysqli_query($db, $query);
	$data = mysqli_fetch_array($result, MYSQLI_NUM);
	if ($data[0] >= 1) {
		echo "Route already exists";
		// Return to somewhere if it exists
		// header('location:create_src.php');
	} else {
		// Insert to routes
		$query = "
			INSERT INTO route (origin_address, origin_latitude, origin_longitude, destination_address, destination_latitude, destination_longitude, status, cost)
			VALUES ('{$srcAddr}', {$srcLat}, {$srcLong}, '{$destAddr}', {$destLat}, {$destLong},'Waiting', 0)
		";
		$result = mysqli_query($db, $query) or die("Error $query");

		// Insert to pool
		$routeId = mysqli_insert_id($db);
		$userId = $_SESSION['id'];

		$query = "
			INSERT INTO pool (user_id, route_id)
			VALUES ({$userId}, {$routeId})
		";
		// Note user id must exist in users table, else the query is an error
		$result = mysqli_query($db, $query) or die("Error $query");

		//echo "Successful";

		// Return to homepage
		// header('location:homescreen.php');
		//Return to homepage
		header(HOMEPAGE.'?action=created&entity=route');
	}
