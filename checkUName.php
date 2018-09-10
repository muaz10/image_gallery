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

    $query=$_GET["q"];

    if (strlen($query)>0) {
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
  
        $query = mysqli_real_escape_string($link,$query);
          // makes sure nobody uses SQL injection
                       
        $raw_results = mysqli_query($link,"SELECT `name` FROM administrators
              WHERE (`username` = '".$query."')");
               
        if(mysqli_num_rows($raw_results) > 0){
            echo "Username already exists!";
        }
        else{
            echo "Username available!";
        }
    }
    
    $link->close();
?>