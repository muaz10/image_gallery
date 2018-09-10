<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imagelib";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/***************/

$usname=$_POST['user'];
$pass=$_POST['pwrd'];

$salt = openssl_random_pseudo_bytes(20);
$enpw=crypt($pass,$salt);

$name=$_POST['name'];
$email=$_POST['email'];
$staffid=$_POST['staffID'];
$position=$_POST['positn'];
$gender=$_POST['gender'];
	
if($stmt = $conn->prepare("INSERT INTO administrators (`name`, `username`, `password`, `salt`, `email`, `staff_id`, `position`, `gender`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")){
	$stmt->bind_param("ssssssss", $name, $usname, $enpw, $salt, $email, $staffid, $position, $gender);

	$stmt->execute();
	$_SESSION['user'] = $usname;
	header("location:admin_home.php");
}
else{
	die("error msg: ".$conn->error);
}

	$stmt->close();
	$conn->close(); 
?>