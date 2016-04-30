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

                 // CHECK IF USER IS NEW OR NOT. If new, display "get started here!" to start the authentication/scraping process.
                 if ($row[isNew] == 1)
                 {
                    echo '<BR><BR><h3 class="service-heading text-muted">Start off by checking your email for events! [Python integration via button or new page]</h3>';
                 } 
                 else {
                    // NOTE: THIS NEEDS TO BE CHANGED LATER TO ACTUAL EMAIL! (currently, only have username + pass info)
                    echo '<h3 class="section-subheading text-muted">Here are your events from ' .$row[User]. ' email.</h3> 
                          </div>
                          </div>';
                 }

         echo '<center>


         <!-- MAP DISPLAY GOES HERE!!!!!!!!!!!!!!!!!1 -->
   <BR><div id="map" style="width: 400px; height: 500px;"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: 40.3573, lng: -74.6672};

        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 13,
          center: myLatLng
        });

        var addresses = [
            ["Bloomberg Hall Princeton, NJ 08544", "Chipotle study break", 0, 0],
            ["Joline Hall Princeton, NJ 08544", "Ice cream study break", 0, 0]
        ];


        var geocoder = new google.maps.Geocoder();

        var marker, i;

        for (i = 0; i < addresses.length; i++){
               geocodeAddress(geocoder, map, addresses[i]);
        }
      }


function geocodeAddress(geocoder, resultsMap, events) {
    var infowindow = new google.maps.InfoWindow();



      geocoder.geocode( { "address": events[0]}, function(results,status) {
          if (status == google.maps.GeocoderStatus.OK) {

              var marker = new google.maps.Marker({
                  position: results[0].geometry.location,
                  map: resultsMap
              });

              google.maps.event.addListener(marker, "mouseover", function() {
                      infowindow.setContent(events[1]);
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

         /* var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: "Hello World!" 
        }); 


        var contentString = "Study Break at Chipotle";

        var infowindow = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 200
        });

        marker.addListener("click", function() {
          infowindow.open(map, marker);
        });



        */


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
         <form action="index.html">
            <button type="submit" class="btn btn-xl">View, Add, Delete, or Edit Your Events</button>
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
              echo "<input type='submit' value='Unsubscribe' class='text_button'><br>";
              echo '</form>';
                        echo '</h3> 
                        </li>
                        <li><a href="pp.html" target="_blank">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
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



