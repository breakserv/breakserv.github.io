<?php

       // Connect to the database for the entry of the CSV stuff into the database.
      $dbhost = 'localhost';
      // $dbuser = 'atian_atian';     // CHANGE IT TO YOUR DATABASE USER NAME
      $dbuser = 'shuyangl_syl';
      $dbpass = 'orf401bs';            // CHANGE IT TO YOUR DATABASE PASSWORD
      $dbname = 'shuyangl_bs';     // CHANGE IT TO YOUR DATABASE NAME
      
      $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');

      mysql_select_db($dbname);

?>
