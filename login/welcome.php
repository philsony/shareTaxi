<?php
  require('../connect.php');

	$sql = "SELECT * FROM pool WHERE user_id = $userId ";
    $result = mysqli_query($db,$sql);
    
	$count = mysqli_num_rows($result);

?>
<html>

   <head>
      <title>Welcome </title>
        <link rel="stylesheet" href="../assets/css/global.css">
		<link rel="stylesheet" href="css/general_style.css" />
        
   </head>

   <body class="login-generic">
     	<?php
       		include('../core/alerts.php');
      	?>
      	<h1>Welcome <?php echo $_SESSION['login_user']; ?></h1>
	  <?php
		if($count>0){
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$routeId = $row['route_id'];
				$sql = "SELECT * FROM route WHERE route_id = '$routeId'";
				$result2 = mysqli_query($db,$sql);
				$row2 = mysqli_fetch_array($result_2,MYSQLI_ASSOC);
				$_SESSION['pool_id'] = $row['pool_id'];
				if($row2['status']!="FINISHED"){
				echo '<div>	
						<div>Route origin : '.$row2['origin_address'].'</div>
						<div>Route destination : '.$row2['destination_address'].'</div>
						<div>Route is : '.$row2['status'].'</div>
						<div><a href = "messaging.php">Message</a></div>
					</div>';
				}
			}
		}

	  ?>
		<h2><a href = "profile.php">Profile</a></h2>

        <h2><a href = "<?php echo BASE_URL ; ?>/market/myactive_pools.php">My active Pools</a></h2>
        <h2><a href = "<?php echo BASE_URL ; ?>/route/create_src.php">Create Route</a></h2>
        <h2><a href = "<?php echo BASE_URL ; ?>/market/testmarket.php">Market</a></h2>
        <h2><a href = "settings.php">Settings</a></h2>
        <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
</html>
