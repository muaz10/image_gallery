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

$usname=$_SESSION['user'];

$sql0 = "SELECT `salt` FROM administrators where `username`='$usname'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0){
    while($results = mysqli_fetch_array($result0)){
        $salt = $results['salt'];
    }
}

$uspwd=crypt($_POST['pwrd'],$salt);
$picid=$_POST['picid'];
$category=$_POST['category'];

$msg1 = "Incorrect password!";

$sql2 = "SELECT `username` FROM administrators where `username`='$usname' AND `password`='$uspwd'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0){
    while($results = mysqli_fetch_array($result2)){
        $sql = "DELETE FROM images WHERE `imageid` = '$picid'";
        if($conn->query($sql))
            header("location:admin_category_click.php?category=".$category);
        else    echo "Error: " . $sql . "<br>" . $conn->error;
    }
        
}
else
header("location:delete_permission.php?msg1='".$msg1."'");
    

$conn->close();
?>