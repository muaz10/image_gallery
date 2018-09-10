<?php
session_start();
mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
$link = mysqli_connect("localhost", "root", "", "imagelib");

mysqli_select_db($link,"imagelib") or die(mysql_error());

$title=$_POST['title'];
$subTitle=$_POST['subTitle'];
$category=$_POST['category'];
$creator=$_POST['creator'];
$year=$_POST['year'];
$publisher=$_POST['publisher'];
$placePub=$_POST['placePub'];
$placeTak=$_POST['placeTak'];
$abstract=$_POST['abstract'];
$keywords=$_POST['keywords'];
$path=basename($_FILES["pic"]["name"]);

$callNum="";

$category = htmlspecialchars($category);

$raw_results = mysqli_query($link,"SELECT Call_number FROM category WHERE Category = '".$category."'" ) 
            or die(mysql_error());

if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
    while($results = mysqli_fetch_object($raw_results)){            
        $callNum = $results->Call_number;
    }
}

    $sql = "INSERT INTO images (`title`, `subtitle`, `abstract`, `creator`, `year_taken`, `publisher`, `place_published`, `place_taken`, `keywords`, `call_number`, `object_path_in_archieve`) 
    VALUES ('".$title."', '".$subTitle."', '".$abstract."', '".$creator."', '".$year."', '".$publisher."', '".$placePub."', '".$placeTak."', '".$keywords."', '".$callNum."', '".$path."')";
    
    if ($link->query($sql) === TRUE) {
        header("location:admin_category_click.php?category=".$category);
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
    

$target_dir = "pics/";
$target_file = $target_dir . basename($_FILES["pic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["pic"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "tif" ) {
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {
    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
}

$link->close();

?>