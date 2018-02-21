<?php require "../loginChecker.php"; ?>

<?php
    require "connect.php";

    $route_id = $_POST["route_id"];
    //$deletecq = "DELETE FROM contributions WHERE contribution_id='".$contrid."'";
    $delete_req2 = "DELETE FROM pool WHERE route_id ='".$route_id."'";
    $delete_req = "DELETE FROM route WHERE route_id ='".$route_id."'";
    //$delete = mysqli_query($conn, $deletecq);
    $delete2 = mysqli_query($db, $delete_req2) or die("Error $delete_req");
    $delete = mysqli_query($db, $delete_req) or die("Error $delete_req");

    echo "Successful!";
?>