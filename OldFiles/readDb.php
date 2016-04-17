<?php

      // Connecting database
      include ("connectDb.php");

      // Here is another way of making an SQL query.
      // $sqlt = "SELECT * FROM ridersdb WHERE emailriders = '$email'";
      $sqlt = "SELECT * FROM ridersdb INNER JOIN tripdb ON emailtrip = emailriders WHERE emailriders = '$email' ";
      $sql_isuser = "SELECT * FROM ridersdb WHERE emailriders = '$email'";

      // Again, Send the request
      $result = mysql_query($sqlt);
      $req_isuser = mysql_query($sql_isuser);

      // See if we get an OK result
      if (!$result) {
          die('SQL Error Getting User Information: ' . mysql_error());
      }
      else {
	$found = number_format(mysql_num_rows($result));
      $founduser = number_format(mysql_num_rows($req_isuser));
	$row = mysql_fetch_array($result);
      $row_user = mysql_fetch_array($req_isuser);
	$passdB = $row_user["pass"];    //find password
      }

      mysql_close($conn);
?>
