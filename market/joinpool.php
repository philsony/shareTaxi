<?php
  session_start();
  require('../connect.php');
  $conn = $db;
  $_SESSION['id'] = 1;

  if(isset($_POST['submitme'])){
  	$pool_id = $_POST['pool_id'];
  	$user_id = $_SESSION['id'];
  	$route_id = $_POST['route_id'];

  	$q = "SELECT * FROM pool WHERE user_id = $user_id AND route_id = $route_id";
    $result = mysqli_query($conn, $q);
    $rows = mysqli_num_rows($result);
    if($rows != 0){
      echo "You are already in this pool.";
  	}else{
  		$query = "INSERT INTO pool VALUES (NULL, $user_id, $route_id)";
  		$resulttwo = mysqli_query($conn,$query);
  		echo "Join Pool# ".$pool_id;
  	}
  }
