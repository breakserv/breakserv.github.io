<?php  // Use the <?php command so the server realizes this is PHP code and not HTML

     $coded_eventname = $_GET["name"];
     $coded_date = $_GET["date"];
     $coded_time = $_GET["time"];
     $food = $_GET["food"];
     $place = $_GET["place"];
     $user = $_GET["user"];

     $decoded_date = base64_decode($date);

     echo 'Success!';
     include ("connectDb.php");
     echo '<BR>' .$name;
          echo '<BR>' .$decoded_date;
          echo '<BR>' .$time;
          echo '<BR>' .$food;
          echo '<BR>' .$place;
          echo '<BR>' .$user;
     
     //$sql2 = "INSERT INTO Events (eUser) VALUES ('x')";
     $sql = "INSERT INTO Events (eUser, eventName, eLocation, eDetails) VALUES ('$user', '$name', '$place', '$food')";
     $result = mysql_query($sql);
     //$result2 = mysql_query($sql2);

      if ($result==1){
            // echo ' <br> <font color="red"> New User Added! </font> '; 
            // sleep(1);
            echo 'real success';
      } else die('Invalid query: ' . mysql_error());


     // Set the variable $q equal to whatever follows the "?query=" in the URL
     /* $q = $_GET["query"];
     $t = $_GET["searchtype"];

     if (!$q){  // If the "query" line is blank, display the search page

         // The following echo commands generate standard HTML output for the browser to view.
         echo "<HTML>";
         echo "<TITLE> ORF 401: Assignment #1 - PHP - Spring 2016 </TITLE>";
         echo "<BODY>";

         echo '<center>';
         echo "<br><br>";
         echo "<h1>Ride share with Pear!</h1>";
         echo "<img src='Logo.png' /> <br><br>";   // adding a picture
         echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';   // setting background color

         echo "Enter a single origin/destination to search for. <br>";
             echo "Type a 2-letter state abbreviation such as NY.<br><br>";

         // Notice the creation of a form in HTML.

         // <form action= ""> tells says which page to send the results of the form to.
         // <input type="text"> denotes a text input, the name="query" part
         echo '<form action="isindexSearch.php" method="get">';
         echo '<input type="text" name="query" />';
             
         echo '<select name="searchtype">';
         echo '<option value="origin">Origin</option>';
         echo '<option value="destination">Destination</option>';
         echo '</select>';
            
         echo '<input type="submit" />';
         echo '</form>';      // End the Form    
             
             
        echo '</center>';
         // Closing HTML
         echo "</BODY>";
         echo "</HTML>";

     } else { // In this case, else means that there was some kind of data passed to the PHP script in the URL


        echo "<HTML>";
        echo "<TITLE> ORF 401: Assignment #1 - PHP - Search Results for " . $q . " </TITLE>";
        echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';

        echo '<center>';
        echo "Searching for " . $q . " as " . $t . " <br><br>";
            
            echo "<a href=\"http://atian.mycpanel2.princeton.edu/ORF401/lab1/isindexSearch.php\"><img src='HOME.png' /></a>";

        //echo "<br> DEBUG: Attempting to Execute the command <br>";

        // This is the java program we want to run and the parameters we want to pass to it.
        // You could also use:
        // $string = "ls"
        // or something as a test.

        $string = "/usr/bin/java -Dformat=html RidersSearchServer newriders.dat " . $q . " " . $t;

        // echo $string . '<br><br>';

        // Tell the server to run the command, which launches Java, and store the results in the variable $output
        $output = shell_exec($string);

        echo $output;
        echo '</center>';
        echo "</BODY>";
        echo "</HTML>";
     } */
?>