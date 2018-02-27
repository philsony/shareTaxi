<?php
  require('../connect.php');

	$sql="SELECT * FROM pool WHERE user_id=$userId ORDER BY `pool_id` LIMIT 3";
    $result=mysqli_query($db,$sql);
    
	$count=mysqli_num_rows($result);

?>
<html>
   <head>
      <title>Welcome </title>
        		<link rel="stylesheet" href="../assets/css/global.css">
				<link rel="stylesheet" href="css/bootstrap.min.css" />
				<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
        		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<link rel="stylesheet" href="css/general_style.css" />
				<script src='https://code.jquery.com/jquery-latest.js'></script>
   </head>
   <body class="welcome">
	 	<div class="container-fluid">
		 	<div class="row">
			 	<div class="col-md-10 col-md-offset-1">
				 <br><br>
     		<?php
       		include('../core/alerts.php');
		  ?>
		  	<div class='container-fluid'>
				<div class='row'>
					<div class="col-md-4 col-md-offset-1">
						<a href="<?php echo BASE_URL ; ?>/market/myactive_pools.php">
							<div class='node'>
								<i class="fa fa-car"></i> My Active Pools
							</div>
						</a>
						<a href="<?php echo BASE_URL ; ?>/route/create_src.php">
							<div class='node'>
								<i class="fa fa-road"></i> Create Route
							</div>
						</a>
						<a href="<?php echo BASE_URL ; ?>/market/testmarket.php">
							<div class='node'>
								<i class="fa fa-shopping-cart"></i> Market
							</div>
						</a>
						<a href="settings.php">
							<div class='node'>
								<i class="fa fa-wrench"></i> Settings
							</div>
						</a>
						<a href="logout.php">
							<div class='node'>
								<i class="fa fa-sign-out"></i> Sign Out
							</div>
						</a>
					</div>
					<div class='col-md-5 col-md-offset-1'>
						<div class='box bg-light text-normal'>
							<h3>Welcome, <?php echo $_SESSION['login_user']; ?>!</h3>
							<br /><?php
								if($count>0){
									while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
										$routeId=$row['route_id'];
										$sql="SELECT * FROM route WHERE route_id='$routeId' ORDER by `route_id` ASC LIMIT 3";
										$result2=mysqli_query($db,$sql);
										$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
										$_SESSION['pool_id']=$row['pool_id'];
										if($row2['status']!="FINISHED"){
										echo '<div class="box-mini">	
												<p>'.$row2['origin_address'].' to  
												'.$row2['destination_address'].'</p>
												<span><a href="/messaging/'. $userId . '/' . $row['pool_id'].'"><button class="submit">Message</button></a></span>&nbsp;&nbsp;&nbsp;&nbsp;
												<span class="statuser">'.$row2['status'].'</span>
											</div>';
										}
									}
								}

							?>
						</div>
					</div>
				</div>
	  	</div>
		<br><br>
	</div>
				</div>
			</div>
   </body>
</html>
