   <?php

   $user = $_POST["User"];
   $pass = $_POST["Pass"] ;

   if(!$user or !$pass){
      echo "<html>";
      echo "<title> Empty fields </title>";
      echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
      echo '<BODY BGCOLOR="#313131" TEXT = "white">';
      echo "<br><br><br><br><br><h1><center>Empty Field. Please try again. Redirecting you back. </center></h1>";
      echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.html">';
      echo '</body>';
      echo '</html>';

   } else{
       include ("readDb.php");

       if($found == 0){

          echo "<html>";
          echo' <title> User does not exist </title>';
          //echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
          echo '<BODY BGCOLOR="#313131" TEXT = "white">';
          echo '<br><br><br><br><br><center><h1> User not found. Please try again. Redirecting you back.</h1></center> ';
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html">';
          echo '</body>';
          echo ' </html>';

        } else {
              if($pass != $passdB){
                echo "<html>";
                echo ' <title> Incorrect Password </title>';
                echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
                echo '<BODY BGCOLOR="#313131" TEXT = "white">';
                echo "<br><br><br><br><br><center><h1>Wrong password. Please try again. Redirecting you back.</h1></center> ";
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html">';
                echo '</body>';
                echo ' </html>';

             } else {


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
    echo '<script src="https://apis.google.com/js/client.js?onload=checkAuth"></script>';
    echo '<script type="text/javascript" src="scrape.js"></script>';

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
                 <h2 class="section-heading">Hi, ' .$row[fName]. '. Welcome back!</h2>';
                 echo '<p id="username_hidden" hidden>' .$user. '</p>';
                 echo '<div><p hidden>Request string:</p><p id="phprequest" hidden></p></div>
    <p id="username_hidden" hidden>atian</p>
    <div><button onclick="sendrequests(event) class="btn btn-xl"">Make Requests</button></div>
    <div><p id="printrequests" hidden></p></div>';

                 // CHECK IF USER IS NEW OR NOT. If new, display "get started here!" to start the authentication/scraping process.
                 if ($row[isNew] == 1)
                 {
                    echo '<BR><BR><h3 class="service-heading text-muted">Start off by checking your email for events! [Python integration via button or new page]</h3>';
                    echo '<div id="authorize-div" class="container">
      <!--Button for the user to click to initiate auth sequence -->
      <button id="authorize-button" onclick="handleAuthClick(event)" class="btn btn-xl">
        Authorize
      </button>
    </div>
    <pre id="output" hidden></pre><BR>';
                 } 
                 else {
                  echo '<div id="authorize-div" class="container">
      <!--Button for the user to click to initiate auth sequence -->
      <button id="authorize-button" onclick="handleAuthClick(event)" class="btn btn-xl">
        Scrape Email
      </button>
    </div>
    <pre id="output" hidden></pre>';

                    if ($row[isFree] == 1) {
                        echo '<BR><BR><h3 class="section-subheading text-muted">WARNING. As a free user, you are able to store up to 5 slots. Currently, you are storing '.$row[CurrCount].' events. <BR>If you are storing less than 5 events, scraping will add new events until all slots are filled (nothing will be overwritten). <BR>If you are storing the maximum of 5 events, scraping will overwrite events that you have right now.</h3>';
                    } else {
                        echo '<BR><BR><h3 class="section-subheading text-muted">Currently, you have ' .$row[CurrCount].' events stored with us.</h3>';
                    }
                 }

        echo '<center>';

        echo '<!-- MAP DISPLAY GOES HERE!!!!!!!!!!!!!!!!! Code modified from Google code: https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple -->
        <div id="map" style="width: 450px; height: 500px;"></div>
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

           // Pulling the event information for the user
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
        </script>

         <!-- Detect if free user or not -->';
         if ($row[isFree] == 1)
         {  
                  // ADS!!!!
                  echo '<img src="ad.jpg" class="pull-left"><img src="ad.jpg" class="pull-right">

                  <BR><BR><h3 class="service-heading text-muted">As a free user, you can store up to 5 events at once.</h3>
                  <h3 class="section-subheading text-muted">What does a <a href="index.html#services" target="_blank">Premium membership</a> offer me?</h3>
                  
                  <form action="upgrade.php" method="post">';
                  echo "<input type='hidden' name='User' value=$user />";
                  echo "<input type='hidden' name='Pass' value=$pass />";
                  echo '<button type="submit" class="btn btn-xl">Upgrade Premium</button>
                  </form><BR><BR>';
         } else {
            echo '<h3 class="section-subheading text-muted">You are a Premium user!</h3>';
         }


      echo '<!-- Button to display all events and add, edit, or delete any one of them -->
         <form action="allevents.php" method="post">';
         echo "<input type='hidden' name='User' value=$user />";
         echo "<input type='hidden' name='Pass' value=$pass />";
         echo '<button type="submit" class="btn btn-xl">View, Add, Delete, or Edit Your Events</button>
         </form>';


      echo '<BR><BR><form action="userprofile.php" method="post">';
         echo "<input type='hidden' name='User' value=$user />";
         echo "<input type='hidden' name='Pass' value=$pass />";
         echo '<button type="submit" class="btn btn-xl">My Profile</button>
         </form>

         <BR><BR>
         <form action="index.html">
            <button type="submit" class="btn btn-xl">Logout</button>
         </form>

</center>
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
           }
        }
   }

 ?>