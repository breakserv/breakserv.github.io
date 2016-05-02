<?php

    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST["Email"];
    $oldpass = $_POST["OldPass"];
    $newpass = $_POST["NewPass"];

    $truepass = $_POST["Pass"];
    $user = $_POST["User"];

    // Update if password entered by the user is correct
    if ($oldpass == $truepass) {
        include("connectDb.php");
        $sql = "UPDATE Members SET fName='$fName', lName='$lName', Email='$email' WHERE User='$user'";
        $result = mysql_query($sql);

        if ($result!=1){
            echo '<BODY BGCOLOR="#313131" TEXT = "white">';
            echo '<br><br><br><br><br><center><h1><font color="red"> <b><i> Error. Please Try Again. </font></h1></center>';
            mysql_close($conn);
        }

        if ($newpass != null)
        {
            $sql = "UPDATE Members SET pass='$newpass' WHERE User='$user'";
            $result = mysql_query($sql);

            if ($result!=1){
                echo '<BODY BGCOLOR="#313131" TEXT = "white">';
                echo '<br><br><br><br><br><center><h1><font color="red"> <b><i> Error updating password. Please Try Again. </font></h1></center>';
                mysql_close($conn);
            }
        }
        // "new password" is the old password if null 
        else if ($newpass == null)
        {
            $newpass = $truepass;
        }

        echo '<BODY BGCOLOR="#313131" TEXT = "white">';
        echo '<br><br><br><br><br><center><h1>Successfully updated! Returning you home.</h1></center>'; 
        sleep(2);
        echo '<form id="autologin" action="login.php" method="post">';
        echo "<input type='hidden' name='User' value=$user />";
        echo "<input type='hidden' name='Pass' value=$newpass />";
        echo '</form>';
        echo '<script language="javascript">';
        echo 'document.getElementById("autologin").submit();';
        echo '</script>';

    }

    // Otherwise, take them back to the page
    else {
        echo '<BODY BGCOLOR="#313131" TEXT = "white">';
        echo '<br><br><br><br><br><center><h1><font color="red"> <b><i> Password incorrect. Please Try Again. </font></h1></center>';

        sleep(2);
        echo '<form id="autologin" action="userprofile.php" method="post">';
        echo "<input type='hidden' name='User' value=$user />";
        echo "<input type='hidden' name='Pass' value=$truepass />";
        echo '</form>';
        echo '<script language="javascript">';
        echo 'document.getElementById("autologin").submit();';
        echo '</script>';
    }
?>