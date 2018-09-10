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

    //get the q parameter from URL
    $query=$_GET["q"];
    $category=$_GET["category"];
    
    $filter1 = "";
  
    if(strlen($category)!=0){
      $filter1 = " AND `call_number`='".$category."'";  
    }
    
    if (strlen($query)>0) {
      $query = htmlspecialchars($query); 
      // changes characters used in html to their equivalents, for example: < to &gt;

      $query = mysqli_real_escape_string($link,$query);
        // makes sure nobody uses SQL injection
      
      $sql = "SELECT `title` FROM images
      WHERE ((`title` LIKE '%".$query."%') 
      OR (`subtitle` LIKE '%".$query."%') 
      OR (`keywords` LIKE '%".$query."%')
      OR (`creator` LIKE '%".$query."%'))".$filter1." LIMIT 10";
      
      $raw_results = mysqli_query($link,$sql);
            
      if(mysqli_num_rows($raw_results) > 0){
        $hint="";
        while($results = mysqli_fetch_array($raw_results)){
          $z=$results['title'];
          if ($hint=="") {
            $hint='<option value="'. 
            $z. 
            '">';
          } else {
            $hint=$hint . '<option value="' . 
            $z.'">';
          }
        }
      }     
    }    

    // Set output to "no suggestion" if no hint was found
    // or to the correct values
    if ($hint=="") {
      $response="no suggestion";
    } else {
      $response=$hint;
    }

    //output the response
    echo $response;

    $link->close();
?>



