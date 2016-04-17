<?php

    $email = $_POST["Email"];
    $pass = $_POST["Pass"];
    $newpass = $_POST["newpass"];
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $college = $_POST["college"];
    $major = $_POST["major"];

    include ("connectDb.php");

    if ($fName != null)
    {
        $sql = "UPDATE ridersdb SET fName='$fName' WHERE emailriders='$email'";
        $result = mysql_query($sql);
        
        if ($result!=1){
            echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
            echo ' <br> <font color="red"> <b><i> Error at First Name. Please Try Again. </b></i></font>';
            mysql_close($conn);
        }
    }

    
    
    if ($lName != null)
    {
        $sql = "UPDATE ridersdb SET lName='$lName' WHERE emailriders='$email'";
        $result = mysql_query($sql);
        
        if ($result!=1){
            echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
            echo ' <br> <font color="red"> <b><i> Error at Last Name. Please Try Again. </b></i></font>';
            mysql_close($conn);
        }
    }
    
    

    if ($newpass != null)
    {
        $sql = "UPDATE ridersdb SET pass='$newpass' WHERE emailriders='$email'";
        $result = mysql_query($sql);

        if ($result!=1){
            echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
            echo ' <br> <font color="red"> <b><i> Error at New Password. Please Try Again. </b></i></font>';
            mysql_close($conn);
        }
    }
    // "new password" is the old password if null 
    if ($newpass == null)
    {
        $newpass = $pass;
    }

    // Update college & major regardless of whether the field is null or not
    $sql = "UPDATE ridersdb SET college='$college', major='$major' WHERE emailriders='$email'";
    $result = mysql_query($sql);

    if ($result==1){
        echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
        echo ' <br> <font color="red"> Successfully updated! </font> '; 
        sleep(1);
        echo '<form id="autologin" action="login.php" method="post">';
        echo "<input type='hidden' name='Email' value=$email />";
        echo "<input type='hidden' name='Pass' value=$newpass />";
        echo '</form>';
        echo '<script language="javascript">';
        echo 'document.getElementById("autologin").submit();';
        echo '</script>';
    } else {
        echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
        echo ' <br> <font color="red"> <b><i> Error. Please Try Again. </b></i></font>';
        mysql_close($conn);
    }

?>