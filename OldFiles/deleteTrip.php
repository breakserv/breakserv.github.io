<html>
<head>
<title>Member Registration</title>
</head>
<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>
<BODY BGCOLOR="#c5d9c1" TEXT = "black">

<?php
      //get variables
      $tripID = $_POST["tripID1"];
      $email = $_POST["Email"];
      $pass = $_POST["Pass"];

      include ("readDb.php");

      //update information now
      echo "Deleting trip information now... ";

      include ("connectDb.php");

      $sql = "DELETE FROM tripdb WHERE tripID = '$tripID' AND emailtrip='$email'";

      $result = mysql_query($sql);

      if ($result==1){
      	    echo ' <br> <font color="#000000"> Trip deleted! </font> ';
            sleep(3);
            echo '<form id="autologin" action="login.php" method="post">';
            echo "<input type='hidden' name='Email' value=$email />";
            echo "<input type='hidden' name='Pass' value=$pass />";
            echo '</form>';
            echo '<script language="javascript">';
            echo 'document.getElementById("autologin").submit();';
            echo '</script>';
      } else
       	    echo ' <br> <font color="#000000"> <b><i> Error. Please Try Again. </b></i></font>';      	

      mysql_close($conn);
 ?>

