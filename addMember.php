<html>
<head>
<title>BreakServ - Member Registration</title>
</head>
<BODY BGCOLOR="#313131" TEXT = "white">

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

                 // Database insertion. Some columns have default values, so ignore those when inserting into database
                 $sql = "INSERT INTO Members (fName, lName, Email, User, pass, lastScanDate) VALUES ('$fname' ,'$lname', '$email', '$user', '$pass', '1111-11-11')";
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

       			     echo ' <br><br><br><br><br><center><h1> <font color="red"> Error. Please Try Again. </font></h1></center>';

                 mysql_close($conn);
      	
              } else {
      		       echo "<br><br><br><br><br><center><h1>You didn't include all the information. Please Try Again. Redirecting you to Registration. </h1></center>";
                   echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=newMember.html">';
     	      }

      }  else {
          echo "<br><br><br><br><br><center><h1>Username already exists. Please log in or try registering again. Redirecting you home</h1></center>";
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html#login">';
      }

 ?>

