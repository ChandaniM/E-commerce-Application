<?php
$connection=OpenCon();
function OpenCon(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database ="ecommerce-application";
	$conn = new mysqli($servername, $username, $password,$database) or die("Connect failed: %s\n". $conn -> error);
	return $conn;
}
 
function CloseCon($conn){
 $conn -> close();
}
// Check connection
	
	// echo "Connected successfully";
   
?>