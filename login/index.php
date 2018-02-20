<?php
   include('session.php');
	
	
	//will be changed in the future for cache login
    if(!isset($user_id)){
        header("location: login.php");
    }
?>