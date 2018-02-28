<?php
  require('../connect.php');
  include('../core/alerts.php');

  if(isset($_POST['route_id'])){
    
    
	$sql="SELECT * FROM route WHERE author_id=$userId AND route_id = {$_POST['route_id']} ";
  $result=mysqli_query($db,$sql);
    
	$count=mysqli_num_rows($result);
    if($count == 0){
  	$q = "DELETE FROM pool WHERE route_id = {$_POST['route_id']} AND user_id = {$_SESSION['id']}";
  	$result = mysqli_query($conn,$q);
  	if(mysqli_affected_rows($conn)> 0){
  		header('location:'. BASE_URL."market/myactive_pools.php");
  	}else{
  		echo "error in deleting";
  	}
    } else {
      echo "You cannot leave your own pool";
    }
  }  
?>