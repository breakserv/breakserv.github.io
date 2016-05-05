<?php  // Use the <?php command so the server realizes this is PHP code and not HTML

     $coded_eventname = $_GET["name"];
     $coded_date = $_GET["date"];
     $coded_time = $_GET["time"];
     $coded_food = $_GET["food"];
     $coded_place = $_GET["place"];

     $coded_user = $_GET["user"];
     $user = $coded_user;

     // Decode everything
     if (strcmp($coded_eventname,"null") != 0) $eName = addslashes(base64_decode($coded_eventname));
     else $eName = NULL; 

     if (strcmp($coded_date,"null") != 0) $startDate = addslashes(base64_decode($coded_date)); 
     else $startDate = NULL;

     if (strcmp($coded_time,"null") != 0) $eTime = addslashes(base64_decode($coded_time)); 
     else $eTime = NULL;

     if (strcmp($coded_food,"null") != 0) $foodTypes = addslashes(base64_decode($coded_food)); 
     else $foodTypes = NULL;

     if (strcmp($coded_place,"null") != 0) {
            $eLocation = addslashes(base64_decode($coded_place). " Princeton University"); 
      }
     else $eLocation = NULL;

     include ("readDb.php");
     include ("connectDb.php");

    /* echo '<BR>' .$eName;
     echo '<BR>' .$startDate;
     echo '<BR>' .$eTime;
     echo '<BR>' .$foodTypes;
     echo '<BR>' .$eLocation;
     echo '<BR>' .$user;*/

      // If new user (first time user), update so that they are no longer a new user
     if ($row[isNew] == 1) {
            $sql2 = "UPDATE Members SET isNew=0 WHERE User='$user'";
            $result2 = mysql_query($sql2);
     }
     $newCount = $row[CurrCount];

     // FREE USERS can only have up to 5 events stored in the database
     // If currcount < 5, add new events until it's full
     // If currcount = 5, user is over capacity - don't add anything
      if ($row[isFree] == 1) {
            if ($newCount < 5) {
                  // Add to database (depending on whether the event has food or not)
                  if (!$foodTypes) {
                        $sql2 = "INSERT INTO Events (eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES (('$user'), ('$eName'), ('$startDate'), ('$eTime'), ('$eLocation'), 0, ('$foodTypes'))";
                        $result2 = mysql_query($sql2);
                  }
                  else {
                        $sql2 = "INSERT INTO Events (eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES (('$user'), ('$eName'), ('$startDate'), ('$eTime'), ('$eLocation'), 1, ('$foodTypes'))";
                        $result2 = mysql_query($sql2);
                  }

                  // Update currCount if successful
                  if ($result2==1){
                        $newCount = $row[CurrCount] + 1;
                        $sql2 = "UPDATE Members SET CurrCount='$newCount' WHERE User='$user'";
                        $result2 = mysql_query($sql2);
                  } else die('Invalid query: ' . mysql_error());
            }
            else {
                  // Do nothing
            }
      }

      // PREMIUM USERS can add in as many events as they want . Simply update currCount with it
      else {
            // Add to database (depending on whether the event has food or not)
            if (!$foodTypes) {
                  $sql2 = "INSERT INTO Events (eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES (('$user'), ('$eName'), ('$startDate'), ('$eTime'), ('$eLocation'), 0, ('$foodTypes'))";
                  $result2 = mysql_query($sql2);
            }
            else {
                  $sql2 = "INSERT INTO Events (eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES (('$user'), ('$eName'), ('$startDate'), ('$eTime'), ('$eLocation'), 1, ('$foodTypes'))";
                  $result2 = mysql_query($sql2);
            }

            // Update currCount if successful
            if ($result2==1){
                  $newCount = $row[CurrCount] + 1;
                  $sql2 = "UPDATE Members SET CurrCount='$newCount' WHERE User='$user'";
                  $result2 = mysql_query($sql2);
            } else die('Invalid query: ' . mysql_error());
     }

      mysql_close($conn);
?>