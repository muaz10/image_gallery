<?php
    mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    $link = mysqli_connect("localhost", "root", "", "imagelib");

     
    mysqli_select_db($link,"imagelib") or die(mysql_error());
   
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
		<title>Photo view</title>

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
	
		<!--navigation bar-->
		<nav class="black" id="nav" role="navigation">
			<div class="nav-wrapper container">
				<a id="logo-container" href="index.php" class="brand-logo"><img src = "MainLogo.png"></a>
				<ul class="right hide-on-med-and-down">
				<li><a class="navi" href="https://www.facebook.com/vazdilanson.mathalamuthu" style = "color : white">Contact us</a></li>
				</ul>
			</div>
		</nav>
		<br>
		
		<!--Search bar-->
		<div class = "center" style="width:50%">
			<form class="textbox2"> 
				<div class="input-field">
					<input type="search" id="search-txt" name="query" list="suggestions" onkeyup="showResult(this.value)">
					<label for="search-txt" style="color:#ff8c00">Type any Title or Keyword and hit "Search"</label>
                    <i class="material-icons" style="padding-top:7px">search</i>
                    <datalist id="suggestions"></datalist>
                </div>
                <!--<div class="row center">
                    <input id = "search-button"  class="SerButton waves-effect lighten-1" value="Search" type="submit"/>         
                </div>-->
			</form>
		</div>
		
		
        <?php
        $query = $_GET['pic_id'];
        $picid = $_GET['pic_id'];
        $min_length = 1;
        // you can set minimum length of the query if you want
         
        if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
             
            $query = htmlspecialchars($query); 
            // changes characters used in html to their equivalents, for example: < to &gt;
             
            $query = mysqli_real_escape_string($link,$query);
            // makes sure nobody uses SQL injection
             
            $raw_results = mysqli_query($link,"SELECT *, call_number as x, (select Category FROM category WHERE `Call_number` = x) as y  
                FROM images
                WHERE (`imageid` = ".$query.")") 
                or die(mysql_error());
                 
            // * means that it selects all fields, you can also write: `id`, `title`, `text`
            // articles is the name of our table
             
            // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
            // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
            // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
             
            if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
                 
                while($results = mysqli_fetch_object($raw_results)){
                // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                    
                echo '<div class = "titleBar">';
				echo '<h4 class="frontTitle">'.$results->title.'</h4>';
			    echo '<div class = "titleLine"></div>';
			    echo '</div>';
		        echo '<br><br>';
		
		        echo '<div class="container" style="width:100%">';
		
			    echo '<div class="row">';

                    
                    //image view
                    echo '<div class="col s6" style="width:60%">';
                    echo '<img src="pics/'.$results->object_path_in_archieve.'" style="margin-left:130px; width:80%">';
                    echo '</div>';
                    //end of image view
                    
                    //image description

                    echo '<div class="col s6" style="font:roboto; width:40%">';		
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Image ID : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->imageid.'</h6>';
						echo '</div>';
		
					echo '</div>';
					
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Subtitle : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->subtitle.'</h6>';
						echo '</div>';
		
                    echo '</div>';
                    
                    echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Category : </h6>';
						echo '</div>';
                        echo '<div class="col s9">';                        
                        echo '<h6>'.$results->y.'</h6>';                                            
                        echo '</div>';
		
					echo '</div>';
		
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Abstract : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->abstract.'</h6>';
						echo '</div>';
		
					echo '</div>';
		
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Creator : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->creator.'</h6>';
						echo '</div>';
		
					echo '</div>';
		
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Year Taken : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->year_taken.'</h6>';
						echo '</div>';
		
					echo '</div>';
		
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Publisher : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->publisher.'</h6>';
						echo '</div>';
		
					echo '</div>';
		
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Place Published : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->place_published.'</h6>';
						echo '</div>';
		
					echo '</div>';
					
					echo '<div class="row">';
						echo '<div class="col s3 right-align" >';
						echo '<h6><b>Place Taken : </h6>';
						echo '</div>';
						echo '<div class="col s9">';
                        echo '<h6>'.$results->place_taken.'</h6>';
						echo '</div>';
		
					echo '</div>';					
                    
                }
                 
            }
            else{ // if there is no matching rows do following
                echo "No results";
            }
             
		}
		
		$link->close();
        ?>
	
					
					<div class="row center" style="margin-right:0px">
					
                        
                        <a class="SerButton waves-effect lighten-1" href="request_page.php?id=<?php echo $picid ?>">Request Image</a>
                       
					</div>
				</div>
			</div>
		</div>
		<br><br>
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
        