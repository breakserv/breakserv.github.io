<html>
<head>
<title>Delete an Event</title>
</head>
<BODY BGCOLOR="#313131" TEXT = "white">

<?php
      //get variables
      $eventID = $_POST["eID"];
      $user = $_POST["User"];
      $pass = $_POST["Pass"];

      include ("readDb.php");

      //update information now
      echo '<br><br><br><br><br><center><h1><b><i>Deleting event now...</h1></center>';

      include ("connectDb.php");

      $sql = "DELETE FROM Events WHERE eID = '$eventID' AND eUser='$user' ";

      $result = mysql_query($sql);

      if ($result==1){
            sleep(2);
            echo '<form id="autologin" action="allevents.php" method="post">';
            echo "<input type='hidden' name='User' value=$user />";
            echo "<input type='hidden' name='Pass' value=$pass />";
            echo '</form>';
            echo '<script language="javascript">';
            echo 'document.getElementById("autologin").submit();';
            echo '</script>';
      } else
       	    echo '<br><br><br><br><br><center><h1><font color="red"> <b><i> Error. Please Try Again. </font></h1></center>';      	

      mysql_close($conn);
 ?>

