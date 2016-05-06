   <?php

   $user = $_POST["User"];
   $pass = $_POST["Pass"] ;

   // Connecting to MEMBERS database
   include ("readDb.php");

echo "<html>";

// ***********************************************************************
// TEMPLATE FROM http://startbootstrap.com/template-overviews/agency/ 
// ***********************************************************************

echo "<head>";
    
    echo "<meta charset='utf-8'>";
    echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo '<meta name="description" content="">';
    echo '<meta name="author" content="">';

    echo " <title> BreakServ - " .$row[fName]. "'s profile. </title>";
    echo '<BODY BGCOLOR="#313131" TEXT = "white">';

    echo '
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>';

    echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
    echo '<link href="css/agency.css" rel="stylesheet">';
    echo '<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
    echo '<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">';
    echo "<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>";
    echo "<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>";
    echo "<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>";

    echo "<!--[if lt IE 9]>";
        echo '<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>';
    echo "<![endif]-->";

echo "</head>";

echo '<body id="page-top" class="index">


    <!-- Main Page -->
    <section id="homepage">
    <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="intro-heading"><img src="http://atian.mycpanel2.princeton.edu/breakserv/img/BSLogo.png" width=80%></div>
                 <h2 class="section-heading">'.$row[fName]. '\'s events</h2>';

        echo '<center>';

         //Detect if free user or not
         if ($row[isFree] == 1)
         {  
              // ADS!!!!
              echo '<a href="http://atian.mycpanel2.princeton.edu/ORF401/lab3/isindexSearch.php"><img src="ad.jpg" class="pull-left"></a><a href="http://atian.mycpanel2.princeton.edu/ORF401/lab3/isindexSearch.php"><img src="ad.jpg" class="pull-right"></a>';
         }

        echo '<!-- MAP DISPLAY GOES HERE!!!!!!!!!!!!!!!!! Code modified from Google code: https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple -->
              <!-- Note that code/Google maps API does not account for overlapping markers -->
        <BR><div id="map" style="width: 450px; height: 500px;"></div>
        <script>

        function initMap() {
          var myLatLng = {lat: 40.3573, lng: -74.6672};

          var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: myLatLng
          });

          var addresses = new Array();
          var marker;

          var i = 0; ';

           // Pulling the EVENT information for the user
           include ("connectDb.php");
           $sqlt2 = "SELECT * FROM Events WHERE eUser = '$user' ";
           // Again, Send the request
           $result2 = mysql_query($sqlt2);
           if (!$result2) {
                die('SQL Error Getting User Information: ' . mysql_error());
           } 

           while ($row2 = mysql_fetch_array($result2)) {
                echo '
                addresses[i] = new Array();
                addresses[i][0] = "' . $row2[eLocation] . '";
                addresses[i][1] = "' . $row2[eDetails] . '";
                addresses[i][2] = 0;
                addresses[i][3] = 0;
                addresses[i][4] = "' . $row2[eventName] . '";
                addresses[i][5] = "' . $row2[startDate] . '";
                addresses[i][6] = "' . $row2[eTime] . '";
                addresses[i][7] = "' . $row2[isFood] . '";
                i++; ';
           }

          echo 'var geocoder = new google.maps.Geocoder();

          for (i = 0; i < addresses.length; i++){
                 geocodeAddress(geocoder, map, addresses[i]);
          }
        }

        function geocodeAddress(geocoder, resultsMap, events) {
            var infowindow = new google.maps.InfoWindow();

              geocoder.geocode( { "address": events[0]}, function(results,status) {
                  if (status == google.maps.GeocoderStatus.OK) {

                      <!--resultsMap.setCenter(results[0].geometry.location);-->

                      var marker = new google.maps.Marker({
                          position: results[0].geometry.location,
                          map: resultsMap
                      });

                      google.maps.event.addListener(marker, "mouseover", function() {
                              if (events[7] == 1) {
                                  infowindow.setContent("<b>Event: </b>" + events[4] + "<br><b>Location: </b>" + events[0] + "<br><b>Date: </b>" + events[5] + " at " + events[6] + "<br><b>Food?</b> Yes! <br><b>Details: </b>" + events[1]);
                              }
                              else infowindow.setContent("<b>Event: </b>" + events[4] + "<br><b>Location: </b>" + events[0] + "<br><b>Date: </b>" + events[5] + " at " + events[6] + "<br><b>Food?</b> No <br><b>Details: </b>" + events[1]);
                              infowindow.open(resultsMap,marker);
                      });

                      google.maps.event.addListener(marker, "mouseout", function() {
                             infowindow.close();
                      });

                  } else {
                    alert("Geocode was not successful for the following reason: " + status);
                  }
              });
        }


        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnj2eV9X-3Ri1W0DQOt-o_hHYVj2ox7Xs&callback=initMap">
        </script>';


        echo '<!-- Go back to login homepage --><BR><BR>
         <form action="login.php" method="post">';
         echo "<input type='hidden' name='User' value=$user />";
         echo "<input type='hidden' name='Pass' value=$pass />";
         echo '<button type="submit" class="btn btn-xl">Go back Home</button>
         </form>

        <BR> <!-- Display table of events + add/edit/delete marker -->';
        echo "<CENTER> <TABLE BGCOLOR=white BORDER=1>";
        echo "<TR BGCOLOR=white>";
        echo '<TD style="vertical-align: center; padding: 4px; text-align:center;"><h4>ID</h4></TH>
              <TD style="vertical-align: center; padding: 4px; text-align:center;"><h4>EVENT NAME</h4>
              <TD style="vertical-align: center; padding: 4px; text-align:center; width: 10%;"><h4>DATE</h4></TH>
              <TD style="vertical-align: center; padding: 4px; text-align:center; width: 15%;"><h4>TIME</h4></TH>
              <TD style="vertical-align: center; padding: 4px; text-align:center;"><h4>LOCATION</h4></TH>
              <TD style="vertical-align: center; padding: 4px; text-align:center;"><h4>FOOD?</h4></TH>
              <TD style="vertical-align: center; padding: 4px; text-align:center;"><h4>DETAILS</h4></TH>
              </TR>';

        // Pulling the EVENT information for the user
        include ("connectDb.php");
        $sqlt2 = "SELECT * FROM Events WHERE eUser = '$user' ORDER BY isFood DESC";
        // Again, Send the request
        $result2 = mysql_query($sqlt2);
        if (!$result2) {
             die('SQL Error Getting User Information: ' . mysql_error());
        } 

        while ($row2 = mysql_fetch_array($result2)) {
            echo "<TR BGCOLOR=white>";
            echo "<TD style='vertical-align: center; padding: 4px; text-align:center;'><p class='text'> ".$row2["eID"]." </p></TD>";
            echo "<TD style='vertical-align: center; padding: 4px; text-align:center;'><p class='text'> ".$row2["eventName"]." </p></TD>";
            echo "<TD style='vertical-align: center; padding: 4px; text-align:center; width: 10%;'><p class='text'> ".$row2["startDate"]." </p></TD>";
            echo "<TD style='vertical-align: center; padding: 4px; text-align:center; width: 8%;'><p class='text'> ".$row2["eTime"]." </p></TD>";
            echo "<TD style='vertical-align: center; padding: 4px; text-align:center;'><p class='text'> ".$row2["eLocation"]." </p></TD>";
            if ($row2[isFood] == 1) {
                echo "<TD style='vertical-align: center; padding: 4px; text-align:center;'><p class='text'>Yes!</p></TD>";
            }
            else {
                echo "<TD style='vertical-align: center; padding: 4px; text-align:center;'><p class='text'>No</p></TD>";
            }
            echo "<TD style='vertical-align: center; padding: 4px; text-align:center;'><p class='text'> ".$row2["eDetails"]." </p></TD>";
            echo "</TR>";
        }
        mysql_close($conn);
        echo '</table></center>';


        echo '<BR><BR><BR><h2 class="section-heading">Delete an Event(s)</H3>';
        echo "<form name='delete' action='deleteEvent.php' method='post'>";
        echo '<div class="row">
             <div class="col-lg-12 text-center">
                <FORM action="updateEvent.php" method="post">
                     <div class="form-group">
                         <input type="text" class="form-control" placeholder="Event ID (Type >ALL< exactly as written without > and < to delete all events)" name="eID" required data-validation-required-message="Please enter the event ID.">
                     </div>';
                     echo "<input type='hidden' name='User' value=$user />";
                     echo "<input type='hidden' name='Pass' value=$pass />";
                     echo '<button type="submit" class="btn btn-xl">Delete</button>
                </FORM>
            </div>
         </div>';

        echo '<BR><BR><BR><h2 class="section-heading">Update or Add an Event</H3>';
        echo '<script type="text/javascript">
          function checkvalue() {
            var eid = document.getElementById("eid").value
            if (!eid.match(/\S/)) {
              var nam = document.getElementById("ename").value
              if (!nam.match(/\S/)) {
                alert("Your event must have a name!")
                return false
              } else {
                var mystring = document.getElementById("eLocation").value
                if (!mystring.match(/\S/)) {
                  alert("You must specify a location!")
                  return false;
                } else {
                  return true;
                }
              }
            } else {
              return true;
            }
          }
        </script>';
        echo "<form name='new' onsubmit='return checkvalue(this)' action='updateEvent.php' method='post'>";
        echo '<p class="text-muted">Leave fields BLANK if you do not wish to change them.</p>';
        echo '<div class="row">
             <div class="col-lg-12 text-center">
                <FORM action="updateEvent.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="ID (Leave blank to add a new event)" name="eID" id="eid">
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Event Name" name="eName" id="ename">
                            </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="number" class="form-control" placeholder="Food? (1 = YES, 2 = NO)" name="isFood">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="date" class="form-control" placeholder="Start Date" name="startDate">
                            </div>
                        </div>
                     </div>

                     <div class="form-group">
                            <input type="text" class="form-control" placeholder="Start Time and End Time (input as text)" name="eTime">
                     </div>

                     <div class="form-group">
                         <input type="text" class="form-control" placeholder="Location (Must include zip code and/or city and state) (150 character limit)" name="eLocation" id="eLocation">
                     </div>

                     <div class="form-group">
                         <textarea class="form-control" placeholder="Event details (150 character limit)" name="eDetails" rows="3"></textarea>
                     </div>';
                     echo "<input type='hidden' name='User' value=$user />";
                     echo "<input type='hidden' name='Pass' value=$pass />";
                     echo '<button type="submit" class="btn btn-xl">Add/Update</button></center>
                </FORM>
            </div>
         </div>';

    echo '</center>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; BreakServ 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li>               
              <form id="unsubscribe" action="unsub.php" method="post">';
              echo "<input type='hidden' name='User' value=$user />";
              echo "<input type='hidden' name='SecretPass' value=$pass />";
              echo "<input type='submit' value='Unsubscribe' class='text_button'><br>";
              echo '</form>';
                        echo '</h3> 
                        </li>
                        <li><a href="pp.html" target="_blank">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>';
echo '</html>';
           
        

 ?>