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
				<link rel="stylesheet" href="css/bootstrap.min.css" />
				<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
        		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<link rel="stylesheet" href="css/general_style.css" />
   </head>
   <body class="welcome">
	 	<div class="container-fluid">
		 	<div class="row">
			 	<div class="col-md-10 col-md-offset-1">
				 <br><br>
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
				$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
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
		<br><br>
	</div>
	
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="row">
							<div class="col-md-5 icon text-center">
								<a href = "profile.php">
									<p><h2><i class="fa fa-user"></i></h2></p>
									<p><h4>Profile<h4></p>
								</a>
							</div>	
							<div class="col-md-5 icon col-md-offset-1 text-center">
								<a href = "<?php echo BASE_URL ; ?>/market/myactive_pools.php">
									<p><h2><i class="fa fa-car"></i></h2></p>
									<p><h4>My Active Pools</h4></p>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 text-center">
        						<a href="<?php echo BASE_URL ; ?>/route/create_src.php">
									<p><h2><i class="fa fa-road"></i></h2></p>
									<p><h4>Create Route</h4></p>
								</a>
							</div>
							<div class="col-md-5 col-md-offset-1 text-center">
        						<a href = "<?php echo BASE_URL ; ?>/market/testmarket.php">
									<p><h2><i class="fa fa-shopping-cart"></i></h2></p>
									<p><h4>Market</h4></p>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 text-center">
        				<a href = "settings.php">
									<p><h2><i class="fa fa-wrench"></i></h2></p>
									<p><h4>Settings</h4></p>
								</a></h2>
							</div>
							<div class="col-md-5 col-md-offset-1 text-center">
        				<a href = "logout.php">
									<p><h2><i class="fa fa-sign-out"></i></h2></p>
									<p><h4>Sign Out</h4></p>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
   </body>
</html>
