   <?php

   $user = $_POST["User"];
   $pass = $_POST["Pass"] ;

   if(!$user or !$pass){
      echo "<html>";
      echo "<title> Empty fields </title>";
      echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
      echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
      echo "Empty Field. Please try again. Redirecting you back. ";
      echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.html">';
      echo '</body>';
      echo '</html>';

   } else{
       include ("readDb.php");

       if($found == 0){

          echo "<html>";
          echo' <title> User does not exist </title>';
          echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
          echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
          echo ' User not found. Please try again. Redirecting you back. ';
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html">';
          echo '</body>';
          echo ' </html>';

        } else {
              if($pass != $passdB){
                echo "<html>";
                echo ' <title> Incorrect Password </title>';
                echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
                echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
                echo "Wrong password. Please try again. Redirecting you back. ";
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html">';
                echo '</body>';
                echo ' </html>';

             } else {
              echo "<html>";
              echo " <title> Pear - " .$row[fName]. "'s profile. </title>";
              echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
              echo '<BODY BGCOLOR="#c5d9c1" TEXT = "black">';
              echo '<script type ="text/javascript" src="isEmail.js"></script>
<script type="text/javascript" src="isBlank.js"></script>
<script type ="text/javascript" src="checkTrip.js"></script>';
              echo '<center> <IMG src="Logo.png" width="10%" height="auto"> <br><br>' ;
              echo '<b>Hi, ' .$row[fName]. '. <i>Welcome back!</i> </b><br>';

              echo '<SCRIPT TYPE="text/javascript"> 
              function popup(url) {
                  if (! window.focus)return true; 
                  var href; 
                  if (typeof(url) == "string") href=url; 
                  else href=url.href; 
                  window.open(href, "popupWindow", "width=500,height=700,scrollbars=yes"); 
                  return false; 
              } 
              </SCRIPT>';

              echo '<h3>Your Information</h3>';
              echo "<form name='editU' action='editUser.php' method='post'>";
              echo "<input type='hidden' name='Pass' value=$pass />";
              echo "<input type='hidden' name='User' value=$user />";
              echo '<CENTER><TABLE BGCOLOR="#c5d9c1" BORDER=0 WIDTH=25%>';
              echo '<tr><td><b>First Name:</b></td><td>'.$row[fName].'</td></tr>';
              echo '<tr><td><b>Last Name:</b></td><td>'.$row[lName].'</td></tr>';
              echo '</TABLE></CENTER>';
              echo "<br><input type='submit' value='Update User Info'><br>";
              echo "</form>";
              echo '<br>';

              echo '<h3>Your Current Trips</h3>';
              echo "<CENTER> <TABLE BGCOLOR=white BORDER=1 CELLSPACING=2 CELLPADDING=4 WIDTH=60%>";
              echo "<TR BGCOLOR=white>";
              echo "<TH>Trip ID</TH> ";
              echo "<TH>Origin City</TH>";
              echo "<TH>Origin State</TH>";
              echo "<TH>Destination City</TH>";
              echo "<TH>Destination State</TH>";
              echo "<TH>Departure Date</TH>";
              echo "<TH>Departure Time</TH>";
              echo "<TH>Has Car</TH>";
              echo "<TH>Available Seats</TH>";
              echo "</TR>";

             /* include ("connectDb.php");
              $sqlt = "SELECT * FROM ridersdb INNER JOIN tripdb ON emailtrip = emailriders WHERE emailriders = '$email' ";

              // Again, Send the request
              $result = mysql_query($sqlt);

              while($r2 = mysql_fetch_array($result)) {
                  echo "<TR>";
                  echo "<TD ALIGN=CENTER> ".$r2["tripID"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["oCity"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["oState"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["dCity"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["dState"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["dDate"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["dTime"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["Hascar"]." </TD>";
                  echo "<TD ALIGN=CENTER> ".$r2["Seats"]." </TD>";
                  echo "</TR>";
                }

              mysql_close($conn);
                 
              echo "</TABLE></CENTER>"; */
              echo "<br>";

              echo "<H3>Update or Add a Trip</H3>";
              echo "<form name='new' action='updateTrip.php' method='post' onsubmit='return checkTrip();'>";
              echo '<i>Leave "Trip ID" field BLANK to add a new trip</i>';
              echo '<table width = 400><tr><td>Trip ID: </td><td><input type="text" name="tripID" /></td></tr><tr></tr><tr><td>Origin City:</td> <td> <input type="text" name="oCity" /> </td><td id="oCityReq"></td></tr>
<tr><td>Origin State:</td> <td> <select name="oState">
  <option selected disabled value="">-Select State-</option>
  <option value="AL">Alabama</option>
  <option value="AK">Alaska</option>
  <option value="AZ">Arizona</option>
  <option value="AR">Arkansas</option>
  <option value="CA">California</option>
  <option value="CO">Colorado</option>
  <option value="CT">Connecticut</option>
  <option value="DE">Delaware</option>
  <option value="DC">District Of Columbia</option>
  <option value="FL">Florida</option>
  <option value="GA">Georgia</option>
  <option value="HI">Hawaii</option>
  <option value="ID">Idaho</option>
  <option value="IL">Illinois</option>
  <option value="IN">Indiana</option>
  <option value="IA">Iowa</option>
  <option value="KS">Kansas</option>
  <option value="KY">Kentucky</option>
  <option value="LA">Louisiana</option>
  <option value="ME">Maine</option>
  <option value="MD">Maryland</option>
  <option value="MA">Massachusetts</option>
  <option value="MI">Michigan</option>
  <option value="MN">Minnesota</option>
  <option value="MS">Mississippi</option>
  <option value="MO">Missouri</option>
  <option value="MT">Montana</option>
  <option value="NE">Nebraska</option>
  <option value="NV">Nevada</option>
  <option value="NH">New Hampshire</option>
  <option value="NJ">New Jersey</option>
  <option value="NM">New Mexico</option>
  <option value="NY">New York</option>
  <option value="NC">North Carolina</option>
  <option value="ND">North Dakota</option>
  <option value="OH">Ohio</option>
  <option value="OK">Oklahoma</option>
  <option value="OR">Oregon</option>
  <option value="PA">Pennsylvania</option>
  <option value="RI">Rhode Island</option>
  <option value="SC">South Carolina</option>
  <option value="SD">South Dakota</option>
  <option value="TN">Tennessee</option>
  <option value="TX">Texas</option>
  <option value="UT">Utah</option>
  <option value="VT">Vermont</option>
  <option value="VA">Virginia</option>
  <option value="WA">Washington</option>
  <option value="WV">West Virginia</option>
  <option value="WI">Wisconsin</option>
  <option value="WY">Wyoming</option>
</select></td><td id="oStateReq"></td></tr>
<tr><td>Destination City: </td> <td> <input type="text" name="dCity" /> </td><td id="dCityReq"></td> </tr>
<tr><td>Destination State:</td> <td> <select name="dState">
  <option selected disabled value="">-Select State-</option>
  <option value="AL">Alabama</option>
  <option value="AK">Alaska</option>
  <option value="AZ">Arizona</option>
  <option value="AR">Arkansas</option>
  <option value="CA">California</option>
  <option value="CO">Colorado</option>
  <option value="CT">Connecticut</option>
  <option value="DE">Delaware</option>
  <option value="DC">District Of Columbia</option>
  <option value="FL">Florida</option>
  <option value="GA">Georgia</option>
  <option value="HI">Hawaii</option>
  <option value="ID">Idaho</option>
  <option value="IL">Illinois</option>
  <option value="IN">Indiana</option>
  <option value="IA">Iowa</option>
  <option value="KS">Kansas</option>
  <option value="KY">Kentucky</option>
  <option value="LA">Louisiana</option>
  <option value="ME">Maine</option>
  <option value="MD">Maryland</option>
  <option value="MA">Massachusetts</option>
  <option value="MI">Michigan</option>
  <option value="MN">Minnesota</option>
  <option value="MS">Mississippi</option>
  <option value="MO">Missouri</option>
  <option value="MT">Montana</option>
  <option value="NE">Nebraska</option>
  <option value="NV">Nevada</option>
  <option value="NH">New Hampshire</option>
  <option value="NJ">New Jersey</option>
  <option value="NM">New Mexico</option>
  <option value="NY">New York</option>
  <option value="NC">North Carolina</option>
  <option value="ND">North Dakota</option>
  <option value="OH">Ohio</option>
  <option value="OK">Oklahoma</option>
  <option value="OR">Oregon</option>
  <option value="PA">Pennsylvania</option>
  <option value="RI">Rhode Island</option>
  <option value="SC">South Carolina</option>
  <option value="SD">South Dakota</option>
  <option value="TN">Tennessee</option>
  <option value="TX">Texas</option>
  <option value="UT">Utah</option>
  <option value="VT">Vermont</option>
  <option value="VA">Virginia</option>
  <option value="WA">Washington</option>
  <option value="WV">West Virginia</option>
  <option value="WI">Wisconsin</option>
  <option value="WY">Wyoming</option>
</select></td><td id="dStateReq"></td></tr>
<tr><td>Departure Date:</td> <td> <input type="date" name="dDate" value="1976-01-31" /> </td><td id="dDateReq"></td></tr>
<tr><td>Departure Time: </td> <td> <input type="time" name="dTime" value="00:00:00" /> </td><td id="dTimeReq"></td> </tr>
</table>

<br>Do you have a car? <br>
<table width = 100>
<tr><td> <input type="radio" name="Hascar" value="YES" />  </td> <td>Yes </td></tr>
<tr><td> <input type="radio" name="Hascar" value="NO" /> </td> <td> No </td></tr>
</table>
<br>If you have a car, how many free seats do you have?<br>
<table width = 100>
<tr><td> <input type="number" name="Seats" value="0" />  </td> <td id="SeatsReq"></td></tr>
</table>';
              echo "<input type='hidden' name='Pass' value=$pass />";
              echo "<input type='hidden' name='User' value=$user />";
              echo "<br><input type='submit' value='Update'><br>";
              echo "</form><br>";

              echo "<H3>Delete a Trip</H3>";
              echo "<form name='new1' action='deleteTrip.php' method='post' onsubmit='return !isBlank(\"new1\", \"tripID1\");'>";
              echo '<table width = 400><tr><td>Trip ID: </td><td><input type="text" name="tripID1" /></td></tr></table>';
              echo "<input type='hidden' name='Pass' value=$pass />";
              echo "<input type='hidden' name='User' value=$user />";
              echo "<br><input type='submit' value='Delete'><br>";
              echo "</form><br>";

              echo '<H3>Log Out or Unsubscribe</H3>';
              echo '<a href="index.html"><button>Log Out</button></a><br><br>';
              echo '<form id="unsubscribe" action="deleteMember.php" method="post">';
              echo "<input type='hidden' name='User' value=$user />";
              echo "<input type='submit' value='Unsubscribe'><br>";
              echo '</form>';
              echo "<br>";
              echo '<hr>';
              echo ' &copy PEAR app';
              echo "<br>";

              echo ' <font size = 1> Ride share with <i>PEAR</i>! </font>';
              echo '</center>';
              echo "<br>";
              echo "</body>";
              echo ' </html>';
           }
        }
   }

 ?>



