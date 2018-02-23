<?php
   include("../connect.php");

   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $hashed = hash('sha256', $_POST['password']);

      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$hashed);

      $sql = "SELECT * FROM users WHERE email = '$myemail' AND password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
      //Set ID and Username for session.php to access
         //session_register("myusername");
         $_SESSION['id'] = $row['user_id'];
         $_SESSION['login_user'] = $row['name'];
         $_SESSION['user'] = $row;

         header("location: welcome.php");
      }else {
         $error = "You have entered invalid email/password.";
      }
   }
?>
<html>
   <head>
      <title>Login Page</title>
		<link rel="stylesheet" href="css/general_style.css?<?php echo rand(0, 100); ?>" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   </head>
    <body class='login'>
        <div class="blue-overlay"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-4">
                    <div class="title">ShareTaxi</div>
                    <form action= "" method = "post">
                        <div class="error"><?php echo $error; ?></div>
                        <div class="form-group">
                            <label>Email  :</label>
                            <input type="text" required name="email" class="form-control"/>
                            <br />
                        </div>
                        <div class="form-group">    
                            <label>Password  :</label>
                            <input type="password" required name="password" class="form-control" />
                            <br />
                        </div>
                        <div class="form-group">    
                            <input type="submit" class="submit" value="Login"/><br />
                        </div>
                        <br />
                        <div class="create-account"><a href='register.php'>Create Account</a></div>
                    </form>
                </div>
         </div>
    </div>
   </body>
</html>
