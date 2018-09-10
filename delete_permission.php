<?php
session_start();
$username=$_SESSION['user'];
$picid=$_GET['id'];
$category=$_GET['category'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Verify</title>

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
			<li><a href="#!" style="color:#ff8c00">View Requests</a></li>
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
  <p> </p>
  
  <div class="logback">
	<div class = "titleBar">
		<h4 class="frontTitle">VERIFY CREDENTIALS</h4>
		<div class = "titleLine"></div>
	</div>
	<br>
	
	<div class="row" style="width:30%">
		<form class="col s12" action="page5.php" method="post">
			<div class="row">
				<div class="input-field col s12">
					<?php echo '<input type="text" name="user" id="user" value="'.$username.'">';?>
				</div>
			</div>
		
			<div class="row">
				<div class="input-field col s12">
					<input type="password" name="pwrd" id="pwrd" >
					<label for="pwrd"> <?php
          if(isset($_GET['msg1'])){
            echo '<font color="red">';
            echo $_GET['msg1'];
            echo '</font>';
          }
          else echo "Password";
          ?></label>
				</div>
			</div>
      <div class="row center">
        <input id = "submit" name="submit" class="SerButton waves-effect lighten-1" value="Verify" type="submit"/>
    </div>
    <br>
        <input type = "hidden" name = "picid" value = "<?php echo $picid ?>">
        <input type = "hidden" name = "category" value = "<?php echo $category ?>">
		</form>
	</div>
		
	
		
  </div>
  <br>
  
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

  </body>
</html>