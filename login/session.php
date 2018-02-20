<?php
   include('connect.php');
   session_start();
   
   //$user_check = $_SESSION['login_user'];

   $id = $_SESSION['id'];
   
   $ses_sql = mysqli_query($db,"select name, user_id from users where user_id = {$id}");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['name'];

   $user_id = $row['user_id'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>