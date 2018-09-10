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

$usname=$_POST['user'];
$salt = "";

$sql0 = "SELECT `salt` FROM administrators where `username`='$usname'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0){
    while($results = mysqli_fetch_array($result0)){
        $salt = $results['salt'];
    }
}

$uspwd=crypt($_POST['pwrd'],$salt);

$sql = "SELECT `username` FROM administrators where `username`='$usname'";

$result = $conn->query($sql);
$msg1 = "Incorrect password!";
$msg2 = "Username not found. Want to sign up?";

if ($result->num_rows > 0) {
    $sql2 = "SELECT `username` FROM administrators where `username`='$usname' AND `password`='$uspwd'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0){
        while($results = mysqli_fetch_array($result2)){
            $_SESSION['user'] = $results['username'];
            header("location:admin_home.php");
        }
        
    }
    else
    header("location:login.php?msg1='".$msg1."'");
    
}
else{
	header("location:login.php?msg2='".$msg2."'");
}

$conn->close();
?>