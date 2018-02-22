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
