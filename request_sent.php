<?php
    mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    $link = mysqli_connect("localhost", "root", "", "imagelib");

    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysqli_select_db($link,"imagelib") or die(mysql_error());
    /* tutorial_search is the name of database we've created */

    
?>
<!DOCTYPE html>
  <html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
		<meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
		<title>Request Page</title>

		<!-- Favicons-->
		<link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
		<!-- Favicons-->
		<link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
		<!-- For iPhone -->
		<meta name="msapplication-TileColor" content="#00bcd4">
		<meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
		<!-- For Windows Phone -->


		<!-- CORE CSS-->    
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
		<!-- CSS for full screen (Layout-2)-->    
		<link href="css/layouts/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
		<!-- Custome CSS-->    
		<link href="css/custom/custom.css" type="text/css" rel="stylesheet" media="screen,projection">
	

		<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
		<link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- CSS  -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>

    <body>
	
		<!--Navigation Bar-->
		<nav class="black" id="nav" role="navigation">
			<div class="nav-wrapper container">
				<a id="logo-container" href="index.php" class="brand-logo"><img src = "MainLogo.png"></a>
				<ul class="right hide-on-med-and-down">
				<li><a class="navi" href="https://www.facebook.com/vazdilanson.mathalamuthu" style = "color : white">Contact us</a></li>
				</ul>
			</div>
		</nav>
		<br>
        <?php
        $imageID = $_GET['imageid'];
        $name = $_GET['first_name']." ".$_GET['last_name'];
        $address = $_GET['address'];
        $email = $_GET['email'];
        $date = date("Y-m-d");
        $purpose = $_GET['purpose'];
                
        $sql = "INSERT INTO request (`image_id`, `name`, `address`, `email`, `request_date`, `reason`)
                VALUES ($imageID, '$name', '$address', '$email', '$date', '$purpose')";

        if ($link->query($sql) === TRUE) {
            echo '<div class = "titleBar">
            <h4 class="frontTitle">Your request was succesfully sent!</h4>
            <div class = "titleLine"></div>
            </div>';
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }

		$link->close();
        ?>
		
		<br><br><br><br><br><br><br>
		
		<div class="row center">
			<a href="index.php" class="SerButton waves-effect lighten-1">Go back to Home Page</a>
		</div>

        <br><br><br><br><br><br><br><br><br><br>

		<div class="footer1">
      <div class="container">
      Made by <a style="color:#ffffff" href="https://www.facebook.com/vazdilanson.mathalamuthu">Team Imperium</a>
      </div>
    </div>
		
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
    
	</body>
  </html>
        