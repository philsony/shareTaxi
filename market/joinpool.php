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
		alert("Success!");
	});
</script>

<?php

  require('../connect.php');

      if(isset($_POST['submitme'])){
      	$poolId = $_POST['pool_id'];
      	$userId = $_SESSION['id'];
      	$routeId = $_POST['route_id'];
        $return = 'Location: '.BASE_URL.'market/myactive_pools.php?action=joined&entity=You';
      	$q = "SELECT * FROM pool WHERE user_id = $userId AND route_id = $routeId";
        $result = mysqli_query($conn, $q);
        $rows = mysqli_num_rows($result);
        if($rows != 0){
          echo "You are already in this pool.";
      	}else{
      		$query = "INSERT INTO pool VALUES (NULL, $userId, $routeId)";
      		$resultTwo = mysqli_query($conn,$query);
      		header($return);
      	}
      }

