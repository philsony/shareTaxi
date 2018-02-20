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
		<h2><a href = "welcome.php">Homepage</a></h2>
        <h2><a href = "logout.php">Sign Out</a></h2>
        <h2><a href = "settings.php">Settings</a></h2>
   </body>
   
</html>