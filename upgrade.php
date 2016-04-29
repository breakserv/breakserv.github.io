<html>
<head>
<title>BreakServ - Membership Upgrade</title>
</head>
<BODY BGCOLOR="#313131" TEXT = "white">

<?php
      //get variables
      $user = $_POST["User"];
      $pass = $_POST["Pass"];

      include ("readDb.php");
      //get variables from readDB.php
      //add users now
      if ($found != 0){

          include ("connectDb.php");

          // Update membership
          $sql = "UPDATE Members SET isFree = 0 WHERE User='$user'";
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

          } else echo ' <br><br><br><br><br><center><h1><font color="red"> <b><i> Error. Please Try Again. </font></h1></center>';

          mysql_close($conn);
      	
      } else {
      		echo "<br><br><br><br><br><center><h1>Cannot read the database. Logging you out. </h1></center>";
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.html">';
     	}
 ?>

