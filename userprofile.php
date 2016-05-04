   <?php

   $user = $_POST["User"];
   $pass = $_POST["Pass"] ;
    include ("readDb.php");

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
                 <h2 class="section-heading">'.$row[fName]. '\'s Profile</h2>
                 <h2 class="section-subheading text-muted">Username: '.$user.'</h2><BR>';
        echo '<center>';

        echo '<div class="row">
             <div class="col-lg-12 text-center">
                <FORM action="updateUser.php" method="post">
                    <div class="from-group row">
                          <label for="fName" class="col-sm-2 form-control-label"><p class="text-muted">First Name *</p></label>
                          <div class="col-sm-10">
                               <input type="text" class="form-control" name="fName" value="'.$row[fName].'" required data-validation-required-message="Please enter your first name.">
                          </div>
                    </div>
                    
                    <div class="from-group row">
                          <label for="lName" class="col-sm-2 form-control-label"><p class="text-muted">Last Name *</p></label>
                          <div class="col-sm-10">
                               <input type="text" class="form-control" name="lName" value="'.$row[lName].'" required data-validation-required-message="Please enter your last name.">
                          </div>
                    </div>

                    <div class="from-group row">
                          <label for="Email" class="col-sm-2 form-control-label"><p class="text-muted">Email *</p></label>
                          <div class="col-sm-10">
                               <input type="email" class="form-control" name="Email" value="'.$row[Email].'" required data-validation-required-message="Please enter your email.">
                          </div>
                    </div>

                    <div class="from-group row">
                          <label for="OldPass" class="col-sm-2 form-control-label"><p class="text-muted">Old Password *</p></label>
                          <div class="col-sm-10">
                               <input type="password" class="form-control" name="OldPass" placeholder="Old Password *" required data-validation-required-message="Please enter your old password.">
                          </div>
                    </div>

                    <div class="from-group row">
                          <label for="NewPass" class="col-sm-2 form-control-label"><p class="text-muted">New Password</p></label>
                          <div class="col-sm-10">
                               <input type="password" class="form-control" name="NewPass" placeholder="New Password">
                          </div>
                    </div>';

              echo "<input type='hidden' name='Pass' value=$pass />";
              echo "<input type='hidden' name='User' value=$user />";
                     echo '<BR><button type="submit" class="btn btn-xl">Update User Info</button></center>
                </FORM>
            </div>
         </div>';

         //Detect if free user or not
         if ($row[isFree] == 1)
         {  
              // ADS!!!!
              echo '<BR><a href="http://atian.mycpanel2.princeton.edu/ORF401/lab3/isindexSearch.php"><center><img src="kk.JPG"></a>';
         }

        echo '<!-- Go back to login homepage --><center>
         <form action="login.php" method="post">';
         echo "<input type='hidden' name='User' value=$user />";
         echo "<input type='hidden' name='Pass' value=$pass />";
         echo '<BR><BR><button type="submit" class="btn btn-xl">Go back Home</button>
         </form>';

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