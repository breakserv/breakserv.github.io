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
      $startTime = $_POST["startTime"];
      $endTime = $_POST["endTime"];
      $eLocation = $_POST["eLocation"];
      $eDetails = $_POST["eDetails"];

      $user = $_POST["User"];
      $pass = $_POST["Pass"];

      include ("readDb.php");
      include ("connectDb.php");

      if (!$eID) {
            echo "<br><br><br><br><br><center><h1><b><i>Adding event now...</h1></center>";
            if ($isFood == 1) {
                  $sql = "INSERT INTO Events (eID, eUser, eventName, startDate, startTime, endTime, eLocation, isFood, eDetails) VALUES ('$eID', '$user', '$eName', '$startDate', '$startTime', '$endTime', '$eLocation', '$isFood', '$eDetails')";
            }
            else {
                  $sql = "INSERT INTO Events (eID, eUser, eventName, startDate, startTime, endTime, eLocation, isFood, eDetails) VALUES ('$eID', '$user', '$eName', '$startDate', '$startTime', '$endTime', '$eLocation', 0, '$eDetails')";
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
            if ($startTime) {
                  $sql = "UPDATE Events SET startTime='$startTime' WHERE eID = '$eID' AND eUser='$user'";
            }
            if ($endTime) {
                  $sql = "UPDATE Events SET endTime='$endTime' WHERE eID = '$eID' AND eUser='$user'";
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

