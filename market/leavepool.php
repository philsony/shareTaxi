<?php
  require('../connect.php');
  include('../core/alerts.php');

  if(isset($_POST['route_id'])){
  	$q = "DELETE FROM pool WHERE route_id = {$_POST['route_id']} AND user_id = {$_SESSION['id']}";
  	$result = mysqli_query($conn,$q);
  	if(mysqli_affected_rows($con)> 0){
  		header('location:'. BASE_URL."market/myactive_pools.php");
  	}else{
  		echo "error in deleting";
  	}
  }  
?>