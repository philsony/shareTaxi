<?php
  $conn = mysqli_connect("localhost", "root", "", "sharetaxi");
	if (!$conn) {
		printf("Ops. There seems to be a problem. Error: %s\n", mysqli_connect_error());
		exit();
	}
?>
