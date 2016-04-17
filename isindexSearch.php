
     <?php  // Use the <?php command so the server realizes this is PHP code and not HTML


     // Set the variable $q equal to whatever follows the "?query=" in the URL
     $q = $_GET["query"];
	 $t = $_GET["searchtype"];
	 
     if (!$q){  // If the "query" line is blank, display the search page

         // The following echo commands generate standard HTML output for the browser to view.

         echo "<HTML>";
         echo "<TITLE> ORF 401: Lab #2 - PHP - Spring 2016 </TITLE>";
         echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
         echo '<script type ="text/javascript" src="setCookie.js"></script>';
         echo '<script type ="text/javascript" src="getCookie.js"></script>';
         echo '<script type ="text/javascript" src="loadSplashPage.js"></script>';
         echo '<BODY onload="loadSplashPage()" BGCOLOR="#c5d9c1" TEXT = "black">';
         
         echo '<center>';
         echo '<table border="0" width="1000" >';
         echo '<tr>';

         echo ' <td><b><a href="newaccount2.html"><B>Register</B></a> to join the <I>PEAR</I> Community!</b></td>';
         echo ' <td ALIGN=RIGHT><b>Already a Member?</b></td>';
         echo '</tr> <tr>';

         echo '<td>  </td>';

         echo '<td ALIGN=RIGHT><FORM action="login.php" method="post">';
         echo '<P>';
         echo '<LABEL for="email">Email: </LABEL>
              <INPUT type="text" name="Email"><BR>';
         echo '<LABEL for="pass">Password: </LABEL>
              <INPUT type="password" name="Pass"><BR>';

         echo '<div><INPUT type="submit" value="Sign In"></div>';
         echo ' </P>';
         echo '</FORM>';
         echo ' </td> </tr> </table>';

         // echo "<br>";

         echo "<h1>Ride share with <i>PEAR</i>!</h1>";
         echo '<IMG src ="Logo.png", ALIGN = middle>';
         echo "<br><br>";
         echo "Enter a single origin/destination to search for. <br>";
		 echo "Type a city or 2-letter state abbreviation such as NY.<br><br>";

         // Notice the creation of a form in HTML
         // <form action= "">  says which page to send the results of the form to.
         // <input type="text"> denotes a text input, the name="query" part
         echo '<form action="isindexSearch.php" method="get">';
         echo '<input type="text" name="query" />';
		 
         echo '<select name="searchtype">';
         echo '<option value="origin">Origin</option>';
         echo '<option value="destination">Destination</option>';
         echo '</select>';
		
         echo '<input type="submit" />';
         echo '</form>';      // End the Form
		 
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";

         echo '<hr>';
         echo ' &copy PEAR app';
         echo "<br>";

         echo ' <font size = 1> Ride share with <i>PEAR</i>! </font>';

         echo '</center>';

         // Closing HTML
         echo "</BODY>";
         echo "</HTML>";

     } else { // In this case, else means that there was some kind of data passed to the PHP script in the URL

        // Code to deal with an instance of the URL where a ?query= is passed

        // Output the HTML header
        echo "<HTML>";

        echo "<TITLE> ORF 401: Lab #2 - PHP - Search Results for " . $q . " as " . $t . "</TITLE>";
        echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
        echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';

        echo '<center>';
        echo "<br>";
        echo "<a href=\"isindexSearch.php\"><img src='HOME.png', ALIGN = middle /></a>";
        echo "<br><br>";


        // Connecting database
        include ("connectDb.php");
        
		if (strcmp ($t, "origin") == 0) {
        //$sqlt = "SELECT * FROM tripdb WHERE oCity = '$q' OR oState = '$q' ";
        $sqlt = "SELECT * FROM tripdb INNER JOIN ridersdb ON emailtrip = emailriders WHERE oCity = '$q' OR oState = '$q' ";
        $result = mysql_query($sqlt);
        }
		
        else {
        //$sqlt = "SELECT * FROM tripdb WHERE dCity = '$q' OR dState = '$q' ";
        $sqlt = "SELECT * FROM tripdb INNER JOIN ridersdb ON emailtrip = emailriders WHERE dCity = '$q' OR dState = '$q' ";
        $result = mysql_query($sqlt);
        }
		
        // See if we get an OK result
        if (!$result) {
            die('SQL Error Getting User Information: ' . mysql_error());
        }  else
	    $found = number_format(mysql_num_rows($result));

        echo "Searching for " . $q . " as " . $t . "<br>";
        echo "<BR>";

        echo '<STYLE TYPE="text/css">table {
            background-color: #c5d9c1;
            border: 1px solid black;
            cellspacing: 2;
            cellpadding: 4;
            width: 60%;
        }';
        
        echo '<STYLE TYPE="text/css">th.T1, tr.T1 {
            background-color: white;
            border: 1px solid black;
            cellspacing: 2;
            cellpadding: 4;
            width: 60%;
        }</STYLE>';
        
        if ($found>0) {
            
            echo "<CENTER> <table><TR class='T1'>";
            echo "<TR BGCOLOR=white>";
            echo "<TH class='T1'>First Name</TH> ";
            echo "<TH class='T1'>Last Name</TH> ";
            echo "<TH class='T1'>College</TH>";
            echo "<TH class='T1'>Major</TH>";
            echo "<TH class='T1'>Origin City</TH>";
            echo "<TH class='T1'>Origin State</TH>";
            echo "<TH class='T1'>Destination City</TH>";
            echo "<TH class='T1'>Destination State</TH>";
            echo "<TH class='T1'>Departure Date</TH>";
            echo "<TH class='T1'>Departure Time</TH>";
            echo "<TH class='T1'>Has Car</TH>";
            echo "<TH class='T1'>Available Seats</TH>";
            echo "</TR>";
            
            echo "<TR class='T2'><TH class='T2' height=5></TH></TR>";

            $loopct = 0; 
            $last_user = '';
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) 
            { 
                if ($loopct == 0) 
                { 
                    echo "<TR BGCOLOR=white>";
                    echo "<TD ALIGN=CENTER><B> ".$row["fName"]." </B></TD>";
                    echo "<TD ALIGN=CENTER><B> ".$row["lName"]." </B></TD>";
                    echo "<TD ALIGN=CENTER><B> ".$row["college"]." </B></TD>";
                    echo "<TD ALIGN=CENTER><B> ".$row["major"]." </B></TD>";
                    echo "<TD ALIGN=CENTER> ".$row["oCity"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["oState"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dCity"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dState"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dDate"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dTime"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["Hascar"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["Seats"]." </TD>";
                    echo "</TR>";
                     
                    $last_user = $row["fName"]; 
                    $loopct++; 
                }
                
                else if ($row["fName"] == $last_user)
                { 
                    // Only display the trip information
                    echo "<TR BGCOLOR=white>";
                    echo "<TD BGCOLOR=#c5d9c1 ALIGN=CENTER></TD>";
                    echo "<TD BGCOLOR=#c5d9c1 ALIGN=CENTER></TD>";
                    echo "<TD BGCOLOR=#c5d9c1 ALIGN=CENTER></TD>";
                    echo "<TD BGCOLOR=#c5d9c1 ALIGN=CENTER></TD>";
                    echo "<TD ALIGN=CENTER> ".$row["oCity"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["oState"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dCity"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dState"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dDate"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dTime"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["Hascar"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["Seats"]." </TD>";
                    echo "</TR>";
                }
                
                // If current fname != previous row fname
                else
                {
                    echo "<TR class='T2'><TH class='T2' height=5></TH></TR>";
                    
                    echo "<TR BGCOLOR=white>";
                    echo "<TD ALIGN=CENTER><B> ".$row["fName"]."</B> </TD>";
                    echo "<TD ALIGN=CENTER><B> ".$row["lName"]."</B> </TD>";
                    echo "<TD ALIGN=CENTER><B> ".$row["college"]."</B> </TD>";
                    echo "<TD ALIGN=CENTER><B> ".$row["major"]."</B> </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["oCity"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["oState"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dCity"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dState"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dDate"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["dTime"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["Hascar"]." </TD>";
                    echo "<TD ALIGN=CENTER> ".$row["Seats"]." </TD>";
                    echo "</TR>";
                     
                    $last_user = $row["fName"]; 
                }
            }
            
            echo "</TABLE></CENTER>";
            
            
            echo "<H3>Thanks for using <EM>Pear</EM>!</H3></P>";
        } else
            echo "<H3>No related origin/destination found. Search again?</H3>";


         echo "Didn't find what you were looking for? Try again:<br>";

         echo '<form action="isindexSearch.php" method="get">';
         echo '<input type="text" name="query" />';
         
         echo '<select name="searchtype">';
         echo '<option value="origin">Origin</option>';
         echo '<option value="destination">Destination</option>';
         echo '</select>';
        
         echo '<input type="submit" />';
         echo '</form>';      // End the Form


         echo "<br>";
         echo '<hr>';
         echo ' &copy PEAR app ';
         echo "<br>";

         echo ' <font size = 1> Ride share with <i>PEAR</i>! </font>';
         echo '</center>';
         echo "<br>";
     	 echo "</BODY>";
         echo "</HTML>";
     }




