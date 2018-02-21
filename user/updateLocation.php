<?php
  require('../connect.php');
  $response = array();
  $return = BASE_URL.'market/testmarket.php?location=true';

  if(isset($_POST['latitude']) && isset($_POST['longitude'])  ){
    $userchange = "UPDATE users SET location_longitude = '{$_POST['longitude']}' , location_latitude = '{$_POST['latitude']}' WHERE user_id = {$user_id} ";
    $res = mysqli_query($db, $userchange) or die(mysqli_query());
    if($res){
         $response['status'] = 1;
         $response['url'] = $return ;
         $_SESSION['user']['location_longitude'] = $_POST['longitude'] ;
         $_SESSION['user']['location_latitude'] = $_POST['latitude'] ;
         echo json_encode($response);
    }
}
