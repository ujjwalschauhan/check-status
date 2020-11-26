<?php
	include 'database.php';
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$city=$_POST['city'];
	$role=$_POST['role'];
	$sql = "INSERT INTO `user_details`( `name`, `email`, `phone`, `city`, `role`) 
	VALUES ('$name','$email','$phone','$city', '$role')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>
