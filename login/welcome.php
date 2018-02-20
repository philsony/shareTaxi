<?php
   include('session.php');

    if(!isset($user_id)){
        header("location: login.php");
    }
	
	$sql = "SELECT * FROM pool WHERE user_id = '$user_id'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	
?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?></h1> 
	  <?php
		if($count>0){
			$route_id = $row['route_id'];
			$sql = "SELECT * FROM route WHERE route_id = '$route_id'";
			$result_2 = mysqli_query($db,$sql);
			$row_2 = mysqli_fetch_array($result_2,MYSQLI_ASSOC);
			$_SESSION['pool_id'] = $row['pool_id'];
			echo '<div>
					<div>Route is : '.$row_2['status'].'</div>
					<div><a href = "messaging.php">Message</a></div>
				</div>';
			// may be added later, cuz coordinates wouldn't exactly look appealing to the users 
			//<div>Route Origin is : ".$origin."</div>
			//<div>Route Destination is : ".$dest."</div>
		}
	  
	  ?>
		<h2><a href = "profile.php">Profile</a></h2>
        <h2><a href = "logout.php">Sign Out</a></h2>
        <h2><a href = "settings.php">Settings</a></h2>
   </body>
   
</html>