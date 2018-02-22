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
<<<<<<< HEAD
         $error = "You have entered invalid email/password.";
=======
         $error = "Your Email or Password is invalid";
>>>>>>> da52d3f8d44faff150c7da6e726997a343f31182
      }
   }
?>
<html>
<<<<<<< HEAD
   <head>
      <title>Login Page</title>
		<link rel="stylesheet" href="css/general_style.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
   </head>
    <body class='login'>
        <div class="blue-overlay"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-xs-8 col-md-offset-4 col-xs-offset-2">
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
=======

   <head>
      <title>Login Page</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>Email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><a href='register.php'>Create Account</a></div>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>


>>>>>>> da52d3f8d44faff150c7da6e726997a343f31182
</html>
