
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Log In</title>

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
	<!--navigation bar-->
  <nav class="black" id="nav" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo"><img src = "MainLogo.png"></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="navi" href="https://www.facebook.com/vazdilanson.mathalamuthu" style = "color : white">Contact us</a></li>
      </ul>
    </div>
  </nav>
  <p> </p>
  
  <div class="logback">
	<div class = "titleBar">
		<h4 class="frontTitle">LOG IN</h4>
		<div class = "titleLine"></div>
	</div>
	<br>
	
	<div class="row" style="width:30%">
		<form class="col s12" action="page2.php" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input type="text" name="user" id="user" >
					<label for="username"> <?php
          if(isset($_GET['msg2'])){
            echo '<font color="red">';
            echo $_GET['msg2'];
            echo '</font>';
          }
          else echo "Username";
          ?></label>
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
        <input id = "submit" name="submit" class="SerButton waves-effect lighten-1" value="Log In" type="submit"/>
    </div>
    <br>
    <a href="signup.php"> <font color="#E67E00">Don't have an account? sign up here</font></a>
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
