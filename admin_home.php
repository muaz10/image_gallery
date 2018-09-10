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
  <title>Administrator : <?php echo $username ?></title>

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
 
  
  
	<!--search portion-->
  <div id="index-banner" class="parallax-container" style="padding-top:50px">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="center" style = "color : white">Start searching here</h1>
        <div class="row center" style="padding-bottom:30px">
          <h5 class="header col s12 light">You can search any image from the Library of University of Jaffna</h5>
        </div>
			
			<!--search bar with icon-->
		<div class = "center" style="width:50%">
			<form class="textbox1" action="admin_search_results.php" method="GET" id="livesearchForm"> 
				<div class="input-field">
					<input type="search" id="search-txt" list="suggestions" onkeyup="showResult(this.value)" name="query">
					<label for="search-txt" style="color:white">Type any Title/ Keyword/ Image ID and hit "Search"</label>
                    <i class="material-icons" style="padding-top:7px">search</i>
                    <datalist id="suggestions"></datalist>
                </div>
                <div class="row center">
                    <input id = "search-button" class="SerButton waves-effect lighten-1" value="Search" type="submit"/>
                </div>
			</form>
		</div>
        
        <br><br>
		
      </div>
    </div>
    <div class="parallax"><img src="background1.jpg" alt="Unsplashed background img 1"></div>
  </div>
  <br>

  

  <div class = "titleBar">
	<h4 class="frontTitle">CATEGORIES</h4>
	<div class = "titleLine"></div>
  </div>
  <br>
  


	<!--photo slider-->
  <div class="row">
  <?php
    $raw_results = mysqli_query($link,"SELECT Call_number,Category,sample_pic FROM category") 
            or die(mysql_error());

    if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

            for($i=0; $i<4; $i++){
              $results = mysqli_fetch_object($raw_results);
                
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo '<div class="col s12 m7 results"  style = "width:20%" style = "height:25%">';
                echo '<div class="card">';
                echo '<div class="card-image">';
                $category_id = $results->Call_number;
                echo '<img src="category_sample_pic/'.$results->sample_pic.'"/>';
                echo '<span class="card-title">'.$results->Category.'</span>';
                echo '<a href="add_picture.php?callNum='.$category_id.'" class="btn-floating halfway-fab waves-effect waves-light orange"><i class="material-icons">add</i></a>';
                echo "</div>";
                echo '<div class="card-action">';
                echo '<a href="admin_category_click.php?id='.$category_id.'">view images</a>';
                echo "</div></div></div>";
                          
            } 
            
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

        $link->close();
  ?>
		<div class="col s12 m7" style = "width:20%">
          <div class="card">
            <div class="card-image">
              <img src="card5.jpg">
              <span class="card-title">Explore more Categories</span>
            </div>
            <div class="card-action">
              <a href="admin_categories.php">All Categories</a>
            </div>
          </div>
        </div>
		<p class="center-align light">You can quickly access the categories here and view more categories by clicking on "All Categories"</p>
  </div>
	

  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Digitalising the Future</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="pond2.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
			<div class = "titleBar">
				<h4 class="frontTitle">ABOUT US</h4>
			</div>
			<div class = "titleLine"></div>
		<br>
          <p class="para">These set of images contain the ancient history and culture of Jaffna. These hold cultural values. Famous personalities and important places are included. And also drawings and historically important events are recorded here.
          These set of images contain the ancient history and culture of Jaffna. These hold cultural values. Famous personalities and important places are included. And also drawings and historically important events are recorded here.</p>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">It's a facility from the Library - University of Jaffna</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="background3.jpg" alt="Unsplashed background img 3"></div>
  </div>
	
	<br>
	
	<!--footer-->
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
