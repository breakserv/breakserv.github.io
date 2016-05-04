<html>
<head>
<title>Add/Update Event</title>
</head>
<BODY BGCOLOR="#313131" TEXT = "white">

<?php
      //get variables
      $eID = $_POST["eID"];
      $eName = $_POST["eName"];
      $isFood= $_POST["isFood"];
      $startDate = $_POST["startDate"];
      $eTime = $_POST["eTime"];
      $eLocation = $_POST["eLocation"];
      $eDetails = $_POST["eDetails"];

      $user = $_POST["User"];
      $pass = $_POST["Pass"];

      include ("readDb.php");
      include ("connectDb.php");

      // Adding an event
      if (!$eID) {
            // Make sure free users are not over capacity
            if ($row[isFree] == 1 && $row[CurrCount] == 5) {
                  echo "<br><br><br><br><br><center><h1><b><i>You are over capacity (5 events). Please delete an event to proceed.<BR><BR>You will be redirected momentarily.</h1></center>";
                  sleep(2);
                  echo '<form id="autologin" action="allevents.php" method="post">';
                  echo "<input type='hidden' name='User' value=$user />";
                  echo "<input type='hidden' name='Pass' value=$pass />";
                  echo '</form>';
                  echo '<script language="javascript">';
                  echo 'document.getElementById("autologin").submit();';
                  echo '</script>';
            }
            else {
                  // Update CurrCount
                  $newCount = $row[CurrCount] + 1;
                  $sql = "UPDATE Members SET CurrCount='$newCount' WHERE User='$user'";
                  $result = mysql_query($sql);

                  echo "<br><br><br><br><br><center><h1><b><i>Adding event now...</h1></center>";
                  if ($isFood == 1) {
                        $sql = "INSERT INTO Events (eID, eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES ('$eID', '$user', '$eName', '$startDate', '$eTime', '$eLocation', '$isFood', '$eDetails')";
                  }
                  else {
                        $sql = "INSERT INTO Events (eID, eUser, eventName, startDate, eTime, eLocation, isFood, eDetails) VALUES ('$eID', '$user', '$eName', '$startDate', '$eTime', '$eLocation', 0, '$eDetails')";
                  }
            }
      } else {
            echo "<br><br><br><br><br><center><h1><b><i>Updating event now...</h1></center>";

            if ($eName) {
                  $sql = "UPDATE Events SET eventName='$eName' WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($isFood == 1) {
                  $sql = "UPDATE Events SET isFood=1 WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($isFood == 2) {
                  $sql = "UPDATE Events SET isFood=0 WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($startDate) {
                  $sql = "UPDATE Events SET startDate='$startDate' WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($eTime) {
                  $sql = "UPDATE Events SET eTime='$eTime' WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($eLocation) {
                  $sql = "UPDATE Events SET eLocation='$eLocation' WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($eDetails) {
                  $sql = "UPDATE Events SET eDetails='$eDetails' WHERE eID = '$eID' AND eUser='$user'";
            }
      }

      $result = mysql_query($sql);

      if ($result==1){
      	echo '<br><br><br><br><br><center><h1>Event added/updated! </h1></center> ';
            sleep(2);
            echo '<form id="autologin" action="allevents.php" method="post">';
            echo "<input type='hidden' name='User' value=$user />";
            echo "<input type='hidden' name='Pass' value=$pass />";
            echo '</form>';
            echo '<script language="javascript">';
            echo 'document.getElementById("autologin").submit();';
            echo '</script>';
      } else {
            //die('SQL Error: ' . mysql_error());
       	echo '<br><br><br><br><br><center><h1><font color="red"> <b><i> Error. Please Try Again. </font></h1></center>';      	
      }

      mysql_close($conn);

 ?>

