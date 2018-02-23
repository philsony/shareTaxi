<?php
  require('../connect.php');

?>
<html>

   <head>
      <title>Welcome </title>
      <link rel="stylesheet" href="css/general_style.css" /> 
   </head>

   <body>
      <h1>Welcome <?php echo $loginSession; ?></h1>


      <h2><a href = "settings.php">Settings</a></h2>
      <h2><a href = "<?php echo BASE_URL ; ?>/market/myactive_pools.php">Sign Out</a></h2>
      <h2><a href = "welcome.php">Go Back</a></h2>
   </body>

</html>
