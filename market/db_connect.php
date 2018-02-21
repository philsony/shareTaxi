<<<<<<< HEAD
<?php
  $conn = mysqli_connect("localhost", "root", "", "sharetaxi-route");
	if (!$conn) {
		printf("Ops. There seems to be a problem. Error: %s\n", mysqli_connect_error());
		exit();
	}
?>
=======
<?php
  $conn = mysqli_connect("localhost", "root", "", "sharetaxi");
	if (!$conn) {
		printf("Ops. There seems to be a problem. Error: %s\n", mysqli_connect_error());
		exit();
	}
?>
>>>>>>> 433af9c52ccd5fa8649a8d7de447871ae1df4675
