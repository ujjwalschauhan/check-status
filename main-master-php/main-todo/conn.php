<?php 
$conn = mysqli_connect("localhost", "root" , "", "todo");
if($conn){

	echo ("connection established");
	echo "<hr></hr>";
}
else{
	die("Error").mysqli_connect_error();
}
?>