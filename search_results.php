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
  <title>Search results</title>

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
  .textshad{
    text-shadow : 2px 2px;
    #000000;
  }
</head>
<body>
<!--navigation bar-->
  <nav class="black" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo"><img src = "MainLogo.png"></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="navi" href="https://www.facebook.com/vazdilanson.mathalamuthu" style = "color : white">Contact us</a></li>
      </ul>

      
    </div>
  </nav>
  <p> </p>
  <br>
	
	<div class = "center" style="width:50%">
			<form class="textbox2" action="search_results.php" method="GET"> 
				<div class="input-field">
					<input type="search" id="search-txt" list="suggestions" onkeyup="showResult(this.value)" name="query">
					<label for="search-txt" style="color:#ff8c00">Type any Title or Keyword and hit "Search"</label>
					<i class="material-icons" style="padding-top:7px">search</i>
          <datalist id="suggestions"></datalist>
				</div>
			</form>
	</div>
	<h4 class="center-align light">Search Results</h4>
	
	<!--photo results-->
  <div class="row">
    <?php
    $query = $_GET['query']; 
    $filter1 = "";
    if(isset($_GET['category'])){
      $filter1 = "AND `call_number`='".$GET_['category'];
    }
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($link,$query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($link,"SELECT * FROM images
            WHERE (`title` LIKE '%".$query."%') 
            OR (`subtitle` LIKE '%".$query."%') 
            OR (`abstract` LIKE '%".$query."%') 
            OR (`keywords` LIKE '%".$query."%')
            OR (`year_taken` LIKE '%".$query."%')
            OR (`creator` LIKE '%".$query."%')".$filter1) 
            or die(mysql_error());
            
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_object($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo '<div class="results">';
                echo '<div class="col s12 m7"  style = "width:20%">';
                echo '<div class="card">';
                echo '<div class="card-image">';
                echo '<img src="pics/'.$results->object_path_in_archieve.'"/>';
                echo '<span class="card-title textshad">'.$results->title.'</span>';
                echo "</div>";
                echo '<div class="card-action">';
                echo '<a href="photo_view.php?pic_id='.$results->imageid.'">view image</a>';
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                /*"<p><h2>".$results->title."</h2>
                <h3>".$results->subtitle."</h3>
                <h4>".$results->creator."</h4>"
                .'<img src="pics/'.$results->object_path_in_archieve.'"/>'."</p>";*/
                //echo '<img src="pics/'.$results['image'].'"/>';
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
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
