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
    	<style>
			.error {color: #FF0000;}
		</style>
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
		
		<script type="text/javascript">
		function valRequired(){
			var name = document.forms["requestForm"]["first_name"].value;
			var purpose = document.forms["requestForm"]["purpose"].value;
			var email = document.forms["requestForm"]["email"].value;
			var check = true;

			if(name==""){
				document.getElementById("reqName").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqName").innerHTML='*';

			if(purpose==""){
				document.getElementById("reqPurpose").innerHTML='*   This is a required field!';
				check = false;
			}
			else document.getElementById("reqPurpose").innerHTML='*';
			
			if(email==""){
				document.getElementById("reqEmail").innerHTML='*   This is a required field!';
				check = false;
			}
			else document.getElementById("reqEmail").innerHTML='*';

			return check;
			
		}

		</script>
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

		<div class = "titleBar">
				<h4 class="frontTitle">USER DETAILS</h4>
			<div class = "titleLine"></div>
		</div>
		
		<br>
		<?php 
		$query = $_GET['id'];
					
		$raw_results = mysqli_query($link,"SELECT object_path_in_archieve FROM images
		WHERE `imageid` = $query") 
		or die(mysql_error());
		?>
		<div class="container" style="width:100%">
			<div class="row">
			<br>
				<div class="row">
					<div class="col s1">
					</div>
					<div class="col s8 left" style="width:60%">
						<p><span class="error">* required field</span></p>
						
					<div class="row">
							<form class="col s12" onsubmit="return valRequired()" action="request_sent.php" method="GET" name="requestForm">
							<input type="hidden" name="imageid" value="<?=$query;?>" />
							<div class="row">
								<div class="input-field col s6">
									<input id="first_name" name="first_name" type="text">
									<label class="active" for="first_name">First Name<span class="error" id="reqName">* </span></label>
								</div>
								<div class="input-field col s6">
									<input id="last_name" name="last_name" type="text">
									<label class="active"for="last_name">Last Name</label>
								</div>
							</div>
	  
							<div class="row">
								<div class="input-field col s12">
									<input id="address" name="address" type="text">
									<label class="active"for="address">Address</label>
								</div>
							</div>
	  
							<div class="row">
								<div class="input-field col s12">
									<input id="purpose" name="purpose" type="text">
									<label class="active"for="purpose">Purpose<span class="error" id="reqPurpose">* </span></label>
								</div>
							</div>
	  
							<div class="row">
								<div class="input-field col s12">
									<input id="email" name="email" type="email" class="validate">
									<label class="active" for="email" data-error="wrong" data-success="right">Email<span class="error" id="reqEmail">* </span></label>
								</div>
							</div>
							<div class="row center">
								<input id = "search-button" class="SerButton waves-effect lighten-1" value="Submit" type="submit"/>
							</div>
							<br><br>
      
							</form>
						</div>
					</div>
					<div class="col s3 right" style="width:20%; margin-right:130px">
						<br><br><br>
					<?php
										
					if(mysqli_num_rows($raw_results) > 0){
						while($results = mysqli_fetch_object($raw_results)){
							$path = $results->object_path_in_archieve;
							echo '<img src="pics/'.$path.'" style="width:100%; margin-left:50px">';
						}
					}
					else{ // if there is no matching rows do following
						echo "No results";
					}
					$link->close();
					?>					
				
					</div>
				</div>
				
			</div>
		</div>
		
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
        