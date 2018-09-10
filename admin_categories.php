<?php
session_start();
    mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    $link = mysqli_connect("localhost", "root", "", "imagelib");

    mysqli_select_db($link,"imagelib") or die(mysql_error());
   
    $username=$_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Categories</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script>
    function showResult(str) {
      if (str.length==0) { 
        document.getElementById("suggestions").innerHTML="";
        document.getElementById("suggestions").style.border="0px";
        return;
      }
      if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("suggestions").innerHTML=this.responseText;
         // document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
      }
      xmlhttp.open("GET","livesearch.php?q="+str,true);
      xmlhttp.send();
    }
  </script>
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
  <p> </p>
  <br>
	
	<!--search bar-->
	<div class = "center" style="width:50%">
			<form class="textbox2" action="search_results.php" method="GET"> 
				<div class="input-field">
					<input type="search" id="search-txt" list="suggestions" onkeyup="showResult(this.value)" name="query">
					<label for="search-txt" style="color:#ff8c00">Type any Title or Keyword and hit "Search"</label>
					<i class="material-icons"  style="padding-top:7px">search</i>
          <datalist id="suggestions"></datalist>
				</div>
			</form>
	</div>
	
	<div class = "titleBar">
		<h4 class="frontTitle">CATEGORIES</h4>
		<div class = "titleLine"></div>
	</div>
	<br>
	<!--Categories card view-->
  <div class="row">
        <?php
    $raw_results = mysqli_query($link,"SELECT Call_number, Category,sample_pic FROM category") 
            or die(mysql_error());

    if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_object($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo '<div class="col s12 m7"  style = "width:20%" style = "height:25%">';
                echo '<div class="card">';
                echo '<div class="card-image">';
                $category_id = $results->Call_number;
                echo '<img src="category_sample_pic/'.$results->sample_pic.'"/>';
                echo '<span class="card-title">'.$results->Category.'</span>';
                echo '<a href="admin_category_click.php?id='.$category_id.'" class="btn-floating halfway-fab waves-effect waves-light orange"><i class="material-icons">add</i></a>';
                echo "</div>";
                echo '<div class="card-action">';
                echo '<a href="admin_category_click.php?id='.$category_id.'">view more</a>';
                echo "</div></div></div>";
                
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

        $link->close();
  ?>
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
