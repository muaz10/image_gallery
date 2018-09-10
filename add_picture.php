<?php
session_start();
mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
$link = mysqli_connect("localhost", "root", "", "imagelib");
 
mysqli_select_db($link,"imagelib") or die(mysql_error());

$username=$_SESSION['user'];
if(isset($_GET['callNum'])){
	$callNum = $_GET['callNum'];
	$category="abc";
	$raw_results = mysqli_query($link,"SELECT Category FROM category WHERE Call_number = '".$callNum."'" ) 
            or die(mysql_error());

	if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
     error_log("hello",0);
    	while($results = mysqli_fetch_object($raw_results)){            
			$category = $results->Category;
			/*echo '<script>
			document.getElementById("catValue").value="hello";
			
			</script>';*/
    	}
	}
	
}
else{
	$category="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Add Image</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
  <style>
	.logback{
		padding:3% 0% 3% 0%;
	}
  </style>


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
	<div class ="center" style="width:80%">
		<div class = "titleBar">
			<h4 class="frontTitle">ADD IMAGE</h4> 
			<div class = "titleLine"></div>
		</div>
		<br><br>
	</div>
		
	<form onsubmit="" action="page4.php" method="POST" name="addPic" enctype = "multipart/form-data">
	<div class="row right" style="width:80%; padding-right:50px">	
		<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="title" type="text" >
						<label for="title">Title of the Image</label>
					</div>
				</div>
			</div>
			
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="subTitle" type="text" >
						<label for="subTitle" >Subtitle</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<?php echo '<input name="category" value="'.$category.'" type="text" id="catValue">' ?>
						<label for="category" >Category</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="creator" type="text">
						<label for="creator" >Creator</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="year" type="text">
						<label for="year" >Year Taken</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="publisher" type="text" >
						<label for="publisher">Publisher</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="placePub" type="text" >
						<label for="placePub" >Place Published</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:50%">
				<div class="row">
					<div class="input-field col s12">
						<input name="placeTak" type="text" >
						<label for="placeTak">Place Taken</label>
					</div>
				</div>
			</div>

			<div class="left" style="width:100%">
				<div class="row">
					<div class="input-field col s12">
						<input name="abstract" type="text" >
						<label for="abstract">Abstract</label>
					</div>
				</div>
			</div>
		
			<div class="left" style="width:100%">
				<div class="row">
					<div class="input-field col s12">
						<input name="keywords" type="text">
						<label for="keywords" >Keywords</label>
					</div>
				</div>
			</div>
		
			<br><br>
			<div class="center">
				<input id = "Add" class="SerButton waves-effect lighten-1" value="Add Picture" type="submit"/>
			</div>			
		</div>

		<div class="row left" style="width:20%; padding-left:50px; padding-top:160px">		
			<i class="large material-icons">add_a_photo</i>
			<input type="file" name="pic" id="pic" accept="image/*">		
		</div>
	</form>	

	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	<div class="footer1">
		<div class="container">
			Made by <a style="color:#ffffff" href="https://www.facebook.com/vazdilanson.mathalamuthu">Team Imperium</a>
		</div>
    </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
