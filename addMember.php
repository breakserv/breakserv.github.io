<html>
<head>
<title>Member Registration</title>
</head>
<BODY BGCOLOR="#c5d9c1" TEXT = "black">

<?php
      //get variables
      $fname = $_POST["fName"];
      $lname = $_POST["lName"];
      $oCity = $_POST["oCity"];
      $oState= $_POST["oState"];
      $dCity = $_POST["dCity"];
      $dState = $_POST["dState"];
      $ddate = $_POST["dDate"];
      $dtime = $_POST["dTime"];
      $hascar = $_POST["Hascar"];
      $seats = $_POST["Seats"];
      $pass = $_POST["Pass"];
      $email = $_POST["Email"];
      $college = $_POST["College"];
      $major = $_POST["Major"];
      $ref = $_POST["Ref"];


      include ("readDb.php");
      //get variables from readDB.php
      //add users now
      if ($found == 0){

	      if ($fname && $lname && $pass && $email){
      	      	 echo "Adding User " . $fname . " " . $lname . " at ". $email;

                 include ("connectDb.php");

                // Database insertion - make sure to check if there's a referral
                if ($ref == null) {
                    $sql = "INSERT INTO ridersdb (fName, lName, pass, emailriders, major, college, Ref) VALUES ('$fname' ,'$lname', '$pass', '$email', '$major', '$college', 0)";
                    $result = mysql_query($sql);
                }
                else {
                    // Check if the email user is real or not (whether they exist in the db or not)
                    $refupdate = "SELECT * FROM ridersdb WHERE emailriders = '$ref'";
                    $refresult = mysql_query($refupdate);
                    
                    // If referral address is fake, don't give the users an additional free referral point. Let the users know.
                    if (mysql_num_rows($refresult)== 0)
                    {
                        echo '<BR><BR><b>Referral email ' . $ref . ' does not exist. No bonus referral points will be added.</b><BR>';
                        $sql = "INSERT INTO ridersdb (fName, lName, pass, emailriders, major, college, Ref) VALUES ('$fname' ,'$lname', '$pass', '$email', '$major', '$college', 0)";
                        $result = mysql_query($sql);
                    }
                    else {                
                        // If referred properly, BOTH users get 1 extra referral point 
                        $refupdate = "UPDATE ridersdb SET Ref = Ref + 1 WHERE emailriders = '$ref'";
                        $refresult = mysql_query($refupdate);
                        
                        $sql = "INSERT INTO ridersdb (fName, lName, pass, emailriders, major, college, Ref) VALUES ('$fname' ,'$lname', '$pass', '$email', '$major', '$college', 1)";
                        $result = mysql_query($sql);
                        
                    }                    
                }

         if ($oCity == '' || $dCity == '' || $dState == '' || $oState == '' || !isset($hascar)){

         } else{
          $sqltrip = "INSERT INTO tripdb (emailtrip, oCity, oState, dCity, dState, dDate, dTime, Hascar, Seats) VALUES ('$email', '$oCity', '$oState', '$dCity', '$dState', '$ddate', '$dtime', '$hascar', '$seats')";
          $resulttrip = mysql_query($sqltrip);
         }

                 if ($result==1){
      		       echo ' <br> <font color="red"> New User Added! </font> '; 
                       sleep(1);
                       echo '<form id="autologin" action="login.php" method="post">';
                       echo "<input type='hidden' name='Email' value=$email />";
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

