<html>
<head>
<title>BreakServ - Member Registration</title>
</head>
<BODY BGCOLOR="#c5d9c1" TEXT = "black">

<?php
      //get variables
      $fname = $_POST["fName"];
      $lname = $_POST["lName"];
      $user = $_POST["User"];
      $pass = $_POST["Pass"];
      $email = $_POST["Email"];

      include ("readDb.php");
      //get variables from readDB.php
      //add users now
      if ($found == 0){

	      if ($fname && $lname && $user && $pass && $email){
      	      	 // echo "Adding User " . $fname . " " . $lname . " at ". $email;

                 include ("connectDb.php");

                 // Database insertion - make sure to check if there's a referral
                 $sql = "INSERT INTO Members (fName, lName, Email, User, pass) VALUES ('$fname' ,'$lname', '$email', '$user', '$pass')";
                 $result = mysql_query($sql);

                 if ($result==1){
      		             // echo ' <br> <font color="red"> New User Added! </font> '; 
                       // sleep(1);
                       echo '<form id="autologin" action="login.php" method="post">';
                       echo "<input type='hidden' name='User' value=$user />";
                       echo "<input type='hidden' name='Pass' value=$pass />";
                       echo '</form>';
                       echo '<script language="javascript">';
                       echo 'document.getElementById("autologin").submit();';
                       echo '</script>';

                 } else

       			     echo ' <br> <font color="red"> <b><i> Error. Please Try Again. </b></i></font>';

                 mysql_close($conn);
      	
              } else {
      		       echo "<center>You didn't include all the information. Please Try Again. Redirecting you to Registration. <br>";
                 //echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=newMember.html">';
                 echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=newaccount2.html">';
     	      }

      }  else {
          echo "<center>Email already exists. Please log-in. Redirecting you home<br>";
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=isindexSearch.php">';
      }

 ?>

