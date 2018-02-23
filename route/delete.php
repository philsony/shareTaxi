<?php
    require('../connect.php');
    $return = 'Location: '.BASE_URL.'market/myactive_pools.php?action=deleted&entity=Pool';
    $routeId = $_POST["route_id"];
    //$deletecq = "DELETE FROM contributions WHERE contribution_id='".$contrid."'";
    $deleteReq2 = "DELETE FROM pool WHERE route_id ='".$routeId."'";
    $deleteReq = "DELETE FROM route WHERE route_id ='".$routeId."'";
    //$delete = mysqli_query($conn, $deletecq);
    $delete2 = mysqli_query($db, $deleteReq2) or die("Error $deleteReq");
    $delete = mysqli_query($db, $deleteReq) or die("Error $deleteReq");

    header($return);
?>
