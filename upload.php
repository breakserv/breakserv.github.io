<?php  // Use the <?php command so the server realizes this is PHP code and not HTML

     $coded_eventname = $_GET["name"];
     $coded_date = $_GET["date"];
     $coded_time = $_GET["time"];
     $coded_food = $_GET["food"];
     $coded_place = $_GET["place"];

     $user = $_GET["user"];

     // Decode everything
     if (strcmp($coded_eventname,"null") != 0) $eName = base64_decode($coded_eventname);
     else $eName = NULL; 

     if (strcmp($coded_date,"null") != 0) $startDate = base64_decode($coded_date); 
     else $startDate = NULL;

     if (strcmp($coded_time,"null") != 0) $eTime = base64_decode($coded_time); 
     else $eTime = NULL;

     if (strcmp($coded_food,"null") != 0) $foodTypes = base64_decode($coded_food); 
     else $foodTypes = NULL;

     if (strcmp($coded_place,"null") != 0) $eLocation = base64_decode($coded_place); 
     else $eLocation = NULL;

     include ("connectDb.php");
     include ("readDb.php");
     //      echo '<BR>' .$eName;
     //      echo '<BR>' .$startDate;
     //      echo '<BR>' .$eTime;
     //      echo '<BR>' .$foodTypes;
     //      echo '<BR>' .$eLocation;
     //      echo '<BR>' .$user;

      // If new user (first time user), update so that they are no longer a user
     if ($row[isNew] == 1) {
            $sql2 = "UPDATE Members SET isNew=0 WHERE User='$user'";
            $result2 = mysql_query($sql2);
     }

     // FREE USERS can only have up to 5 events stored in the database
     // If currcount < 5, add new events until it's full
     // If currcount = 5, delete everything and add until it's full (or until there are no emails left, whichever is first)

      
      // PREMIUM USERS can add in as many events as they want . Simply update currCount with it
     if ($row[isFree] == 0) {
            // Add to database (depending on whether the event has food or not)
            if (!$foodTypes) {
                  $sql2 = "INSERT INTO Events (eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES ('$user', '$eName', '$startDate', '$eTime', '$eLocation', 0, '$foodTypes')";
                  $result2 = mysql_query($sql2);
            }
            else {
                  $sql2 = "INSERT INTO Events (eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES ('$user', '$eName', '$startDate', '$eTime', '$eLocation', 1, '$foodTypes')";
                  $result2 = mysql_query($sql2);
            }

            // Update currCount if successful
            if ($result2==1){
                  $newCount = $row[CurrCount] + 1;
                  $sql2 = "UPDATE Members SET CurrCount='$newCount' WHERE User='$user'";
                  $result2 = mysql_query($sql2);
            } else die('Invalid query: ' . mysql_error());
     }

      /*if ($result2==1){
            // echo ' <br> <font color="red"> New User Added! </font> '; 
            // sleep(1);
            //echo 'real success';
      } else die('Invalid query: ' . mysql_error());*/
?>