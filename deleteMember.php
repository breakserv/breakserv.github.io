<html>
<head>
<title>Unregister from Pear</title>
</head>
<BODY BGCOLOR="#c5d9c1" TEXT = "black">

<?php

      //get variables
      $email = $_POST["Email"];
      $pass = $_POST["Pass"];

      if(!$pass){
          echo "<center> Are you sure you wish to leave the Pear Community?";
          echo "<center> Please confirm your password below:";
          echo '<FORM action="deleteMember.php" method="post">';
          echo '<P>';
          echo '<LABEL for="pass">Password: </LABEL><INPUT type="password" name="Pass"><BR>';
          echo "<INPUT type='hidden' name='Email' value=$email />";

          echo '<INPUT type="submit" value="Unsubscribe"> ';
          echo ' </P>';
          echo '</FORM>';
          echo '<br> <a href="isindexSearch.php"> Return to Homepage </a> <br>';
          echo '</body> </html>';
      }

      else{

           //get variables from readDB.php
           include ("readDb.php");

	   if ($pass == $passdB) {
               include ("connectDb.php");

               $sql1 = "DELETE FROM ridersdb WHERE emailriders = '$email'"; 
               $sql2 = "DELETE FROM tripdb WHERE emailtrip = '$email'"; // delete from both databases 

               $result = mysql_query($sql1);
               $result2 = mysql_query($sql2);
               if (!result)
	           echo ' <br> <font color="red"> <b><i> Error. Please Try Again. </b></i></font>';
               else
	           echo '<font color="red"> Unregistered from Pear. We hope you will reconsider us in the future. </font>';
	       echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=isindexSearch.php">';
	       echo '</html>';

               mysql_close($conn);
         }

	 else {
	      echo 'Password incorrect. Please try again. You will be redirected momentarily';
              sleep(3);
              echo '<form id="autologin" action="login.php" method="post">';
              echo "<input type='hidden' name='Email' value=$email />";
              echo "<input type='hidden' name='Pass' value=$passdB />";
              echo '</form>';
              echo '<script language="javascript">';
              echo 'document.getElementById("autologin").submit();';
              echo '</script>';
	      echo '</html>';
         }
      }

?>
