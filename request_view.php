<?php
	session_start();
    mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    $link = mysqli_connect("localhost", "root", "", "imagelib");

    mysqli_select_db($link,"imagelib") or die(mysql_error());
   
    $username=$_SESSION['user'];
?>
<!DOCTYPE html>
  <html>
    <head>
    	<style>
			.error {color: #FF0000;}
		</style>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
		<meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
		<title>View Request</title>

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

	<ul id="dropdown1" class="dropdown-content">
		<li><a href="add_picture.php" style="color:#ff8c00">Add Images</a></li>
		<li><a href="request_view.php" style="color:#ff8c00">View Requests</a></li>
		<li class="divider"></li>
		<li><a href="#!" style="color:#ff8c00">Account Settings</a></li>
				
	</ul>
	<!--navigation bar-->
  	<nav class="black" role="navigation">
    	<div class="nav-wrapper container">
      	<a id="logo-container" href="admin_home.php" class="brand-logo"><img src = "MainLogo.png"></a>
      	<ul class="right hide-on-med-and-down">
        	<li><a class="navi" style = "color : white">Welcome <?php echo $username ?>!</a></li>
        	<!-- Dropdown Trigger -->
        	<li style="width:150px"><a class="dropdown-button navi" href="#!" data-activates="dropdown1" style="color:white; text-align:right">Menu<i class="material-icons right">arrow_drop_down</i></a></li>
        	<li><a class="navi" href="index.php" style = "color : white">Sign out</a></li>
		</ul>
	    </div>
  	</nav>
		<br>

		<div class = "titleBar">
				<h4 class="frontTitle center" >REQUESTS</h4><br>
			<div class = "titleLine"></div>
		</div>
		
		<div class="row">
			<div class="col s3">
			</div>
			
			<div class="col s6" >
			<?php
			$raw_results = mysqli_query($link,"SELECT `req_id`, `image_id`, `name` FROM request") 
            or die(mysql_error()); 
			?>
					<ul class="collection">
					<?php
					if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
						while($results = mysqli_fetch_object($raw_results)){
							echo '<li class="collection-item avatar">';
							echo '<div class="row">';
							echo 	'<div class="col s8">';
							echo		  '<img src="1.jpg" alt="" class="circle">';
							echo 		  '<span class="Image ID">Image ID : '.$results->image_id.'</span>';
							echo		  '<p>'.$results->name.' <br></p>';
							
							$reqid = $results->req_id;
							
							echo '</div><div class="col s4"><br>';
									
							echo	'<a class="waves-effect waves-light" href="request_detail.php?reqid='.$reqid.'">View_more<i class="material-icons right">view_headline</i></a>';
							echo 	'</div></div></li>';
							
						}
						 
					}
					else{ // if there is no matching rows do following
						echo "No Requests";
					}
					$link->close();	
					?>	
												
				</ul>
			</div>
		</div>
	<div class="footer1">
    <div class="container">
    Made by <a style="color:#ffffff" href="https://www.facebook.com/vazdilanson.mathalamuthu">Team Imperium</a>
    </div>
    </div>	
		

<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>
