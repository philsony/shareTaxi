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
          
      	}else{
          $query = "INSERT INTO pool VALUES (NULL, $userId, $routeId)";
      		$resultTwo = mysqli_query($conn,$query);
          // Messaging: Informs firestore of a new person in the pool. Do not touch! 
          $fs_sql = "SELECT * FROM users WHERE user_id IN (SELECT user_id FROM pool WHERE route_id = ${routeId})";
          $fs_query = mysqli_query($conn, $fs_sql);
          $fs_result = array();
          while($fs_fetch = mysqli_fetch_assoc($fs_query)) {
            $fs_result[$fs_fetch['user_id']] = $fs_fetch['name'];
          }
          $fs_data = json_encode($fs_result);
          // End of Messaging Event Emit
      	}
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
    window.location("<?php echo BASE_URL.'market/myactive_pools.php?action=joined&entity=You'?>");
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

<div class='content'>
  <img style='width: 50px;' src='<?php echo BASE_URL ?>/assets/images/please_wait.gif' />
</div>
