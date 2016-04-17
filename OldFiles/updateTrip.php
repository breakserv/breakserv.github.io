<html>
<head>
<title>Member Registration</title>
</head>
<BODY BGCOLOR="#c5d9c1" TEXT = "black">

<?php
      //get variables
      $tripID = $_POST["tripID"];
      $oCity = $_POST["oCity"];
      $oState= $_POST["oState"];
      $dCity = $_POST["dCity"];
      $dState = $_POST["dState"];
      $ddate = $_POST["dDate"];
      $dtime = $_POST["dTime"];
      $hascar = $_POST["Hascar"];
      $seats = $_POST["Seats"];
      $email = $_POST["Email"];
      $pass = $_POST["Pass"];

      include ("readDb.php");

      //update information now
      echo "Updating trip information now... ";

      include ("connectDb.php");

      if (!$tripID) {
            $sql = "INSERT INTO tripdb (emailtrip, oCity, oState, dCity, dState, dDate, dTime, Hascar, Seats) VALUES ('$email', '$oCity', '$oState', '$dCity', '$dState', '$ddate', '$dtime', '$hascar', '$seats')";
      } else {
            $sql = "UPDATE tripdb SET oCity='$oCity', oState='$oState', dCity='$dCity', dState='$dState', dDate='$ddate', dTime='$dtime', Hascar='$hascar', Seats='$seats' WHERE tripID = '$tripID' AND emailtrip='$email'";
      }

      $result = mysql_query($sql);

      if ($result==1){
      	    echo ' <br> <font color="#00FF00"> Trip updated! </font> ';
            sleep(3);
            echo '<form id="autologin" action="login.php" method="post">';
            echo "<input type='hidden' name='Email' value=$email />";
            echo "<input type='hidden' name='Pass' value=$pass />";
            echo '</form>';
            echo '<script language="javascript">';
            echo 'document.getElementById("autologin").submit();';
            echo '</script>';
      } else
       	    echo ' <br> <font color="#FF0000"> <b><i> Error. Please Try Again. </b></i></font>';      	

      mysql_close($conn);

 ?>

