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

	$srcAddr =addslashes( $_POST['source']);
	$srcLat	= floatval($_POST['srcLat']);
	$srcLong = floatval($_POST['srcLong']);

	$destAddr =addslashes($_POST['destination']);
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
		$query ="
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

		// Messaging: Informs firestore of a new person in the pool. Do not touch! 
		$fs_sql = "SELECT * FROM users WHERE user_id IN (SELECT user_id FROM pool WHERE route_id = ${routeId})";
		$fs_query = mysqli_query($db, $fs_sql);
		$fs_result = array();
		while($fs_fetch = mysqli_fetch_assoc($fs_query)) {
		  $fs_result[$fs_fetch['user_id']] = $fs_fetch['name'];
		}
		$fs_data = json_encode($fs_result);
		// End of Messaging Event Emit
		// Note user id must exist in users table, else the query is an error
		$result = mysqli_query($db, $query) or die("Error $query");

		//echo "Successful";
	}
?>


<script src="https://www.gstatic.com/firebasejs/4.11.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-firestore.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBs7VM1SUqWyLZVDSuFazk3LcSfIerp8GM",
    authDomain: "sharetaxi-78289.firebaseapp.com",
    databaseURL: "https://sharetaxi-78289.firebaseio.com",
    projectId: "sharetaxi-78289",
    storageBucket: "sharetaxi-78289.appspot.com",
    messagingSenderId: "599684388499"
  };
  firebase.initializeApp(config);

  var db = firebase.firestore();

  db.collection("messages").doc("<?php echo $_POST['route_id']; ?>").set({
    users: <?php echo $fs_data; ?>
  }, {merge: true}).then(function() {
    window.location.href = "<?php echo HOMEPAGE.'?action=created&entity=route'; ?>";
  });
</script>

<style>
  html, body {
    background-color: #292c35 !important;
  }

  .content {
    position: fixed;
    transform: translate(-50%, -50%);
    left: 50%;
    top: 50%;
  }
</style>

<head>
  <meta http-equiv='refresh' content='3;<?php echo BASE_URL.'market/myactive_pools.php?action=joined&entity=You'?>');
</head>

<div class='content'>
  <img style='width: 50px;' src='<?php echo BASE_URL ?>/assets/images/please_wait.gif' />
</div>
