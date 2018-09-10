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
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Image Library - UOJ</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
 
  <script>
    function showResult(str) {
      var e = document.getElementById("category");
      var strUser = e.options[e.selectedIndex].value;

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
      xmlhttp.open("GET","livesearch.php?q="+str+"&category="+strUser,true);
      xmlhttp.send();
    }
  </script>
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
	<!--
  <div class="parallax">
    <img src="background1.jpg" alt="Unsplashed background img 1">
    <p style="text-align: left">Lorem ipsum dolor sit amet, mei ne duis dissentiunt, aeque putent veritus per id, expetendis 
    mediocritatem qui id. Semper percipitur referrentur per in, ius errem zril legendos id. Usu doming 
    luptatum te, cu qui veri dicant repudiare, dico unum nam eu. Vis eu sonet option. Et tamquam contentiones 
    qui, oblique honestatis ut vel. Nec urbanitas persecuti ut.</p>
  </div>-->

	<!--search portion-->
  <div id="index-banner" class="parallax-container" style="padding-top:50px; padding-bottom:50px">
    <div class="section no-pad-bot">
      <div class="container">
        <h1 class="center" style = "color : white">Start searching here</h1>
        <div class="row center" style="padding-bottom:30px">
          <h5 class="header col s12 light">You can search any image from the Library of University of Jaffna</h5>
        </div>
        <div class="center" style="padding-bottom:40px">
          <select name="category" id="category">
          <option selected value>Category</option>
            <option value="1">People</option>
            <option value="2">Places</option>
            <option value="3">Drawings</option>
            <option value="4">Events</option>
          </select>
        </div>
         
			  <!--search bar with icon-->
		    <div class = "center" style="width:50%" >
			    <form class="textbox1" action="search_results.php" method="GET" id="livesearchForm"> 
          
            <div class="input-field" >
              <input type="search" list="suggestions" onkeyup="showResult(this.value)" id="search-txt" name="query">
              <label for="search-txt" style="color:white">Type any Title or Keyword and hit "Search"</label>
              <i class="material-icons" style="padding-top:7px" type="submit">search</i>
              <datalist id="suggestions"></datalist>
            </div>
          <div class="row center">
            <input id = "search-button"  class="SerButton waves-effect lighten-1" value="Search" type="submit"/> 
                    
          </div></form>
          <br>
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
                echo "</div>";
                echo '<div class="card-action">';
                echo '<a href="category_click.php?id='.$category_id.'">view images</a>';
                echo "</div></div></div>";
                          
            } 
            
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
  ?>
		<div class="col s12 m7" style = "width:20%">
          <div class="card">
            <div class="card-image">
              <img src="card5.jpg">
              <span class="card-title">Explore more Categories</span>
            </div>
            <div class="card-action">
              <a href="categories.php">All Categories</a>
            </div>
          </div>
        </div>
		
		<p class="center-align light">You can quickly access the categories here and view more categories by clicking on "View more"</p>
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
          <h5 class="header col s12 light">This is a facility from the Library - University of Jaffna</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="background3.jpg" alt="Unsplashed background img 3"></div>
  </div>
	
	<br>

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

