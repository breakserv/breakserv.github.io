<?php

    $email = $_POST["Email"];
    $pass = $_POST["Pass"] ;

    include ("readDb.php"); #$row_user[<FIELD>], <FIELD> = fName, lName, pass, emailriders, major, college

    echo "<html>";
    echo " <title> Pear - " .$row_user[emailriders]. ": edit profile. </title>";
    echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
    echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
    echo '<script type ="text/javascript" src="isEmail.js"></script>
    <script type="text/javascript" src="isBlank.js"></script>
    <script type ="text/javascript" src="checkUser.js"></script>';
    echo '<center> <IMG src="Logo.png" width="10%" height="auto"> <br><br>' ;
    echo '<h3>Edit User Information</h3>';
    echo "<form name='editU' action='updateUser.php' method='post' onsubmit='return checkUser();'>";
    echo "<input type='hidden' name='Pass' value=$pass />";
    echo "<input type='hidden' name='Email' value=$email />";
    echo '<CENTER><TABLE BGCOLOR="#c5d9c1" BORDER=0>';
    echo '<tr><td><b>Email:</b></td><td>'.$row_user[emailriders].'</td></tr>';
    echo '<tr><td><b>First Name*:</b></td><td><input type="text" name="fName" value="'.$row_user[fName].'" /></td><td id="fNameReq"></td></tr>';
    echo '<tr><td><b>Last Name*:</b></td><td><input type="text" name="lName" value="'.$row_user[lName].'" /></td><td id="lNameReq"></td></tr>';
    echo '<tr><td><b>College:</b></td><td><input type="text" name="college" value="'.$row_user[college].'" /></td><td id="collegeReq"></td></tr>';
    echo '<tr><td><b>Major:</b></td><td><input type="text" name="major" value="'.$row_user[major].'" /></td><td id="majorReq"></td></tr>';
    echo '<tr><td><b>New Password*:</b></td><td><input type="password" name="newpass" value="" /></td><td id="majorReq"></td></tr>';
    echo '<tr><td><b>Current Password:</b> <BR>(Required)</td><td><input type="password" name="currpass" value="" /></td><td id="currpassReq"></td></tr>';
    echo '</TABLE></CENTER>';
    echo "<BR>*If these fields are left blank, they will not be updated.<BR>If College and/or Major are left blank, the current values will be erased.<BR>";
    echo "<br><input type='submit' value='Update Information'><br>";
    echo "</form>";

    echo "<form name='cancel' action='login.php' method='post'>";
    echo "<input type='hidden' name='Pass' value=$pass />";
    echo "<input type='hidden' name='Email' value=$email />";
    echo "<input type='submit' value='Cancel'><br>";
    echo "</form><br>";

    echo "<br>";
    echo '<hr>';
    echo ' &copy PEAR app';
    echo "<br>";

    echo ' <font size = 1> Ride share with <i>PEAR</i>! </font>';
    echo '</center>';
    echo "<br>";
    echo "</body>";
    echo ' </html>';

?>