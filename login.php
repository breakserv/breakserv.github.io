   <?php

   $user = $_POST["User"];
   $pass = $_POST["Pass"] ;

   if(!$user or !$pass){
      echo "<html>";
      echo "<title> Empty fields </title>";
      echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
      echo '<BODY BGCOLOR="#313131" TEXT = "white">';
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
          echo '<BODY BGCOLOR="#313131" TEXT = "white">';
          echo ' User not found. Please try again. Redirecting you back. ';
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html">';
          echo '</body>';
          echo ' </html>';

        } else {
              if($pass != $passdB){
                echo "<html>";
                echo ' <title> Incorrect Password </title>';
                echo '<STYLE TYPE="text/css">BODY { font-family:sans-serif;}</STYLE>';
                echo '<BODY BGCOLOR="#313131" TEXT = "white">';
                echo "Wrong password. Please try again. Redirecting you back. ";
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.html">';
                echo '</body>';
                echo ' </html>';

             } else {


echo "<html>";

// ***********************************************************************
// SKELETAL CODE FROM http://startbootstrap.com/template-overviews/agency/ 
// ***********************************************************************

echo "<head>";
    
    echo "<meta charset='utf-8'>";
    echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo '<meta name="description" content="">';
    echo '<meta name="author" content="">';

    echo " <title> BreakServ - " .$row[fName]. "'s profile. </title>";
    echo '<BODY BGCOLOR="#313131" TEXT = "white">';

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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="http://atian.mycpanel2.princeton.edu/breakserv/index.html">BreakServ</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Main Page -->
    <section id="homepage">
    <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="intro-heading"><img src="http://atian.mycpanel2.princeton.edu/breakserv/img/BSLogo.png" width=80%></div>
                 <h2 class="section-heading">Hi, ' .$row[fName]. '. Welcome back!</h2>';

                 // CHECK IF USER IS NEW OR NOT. If new, display "get started here!" to start the authentication/scraping process.
                 // If isNew = 1, basically.


                 // else....display map with pins

      // NOTE: THIS NEEDS TO BE CHANGED LATER TO ACTUAL EMAIL! (currently, only have username + pass info)
     echo '<h3 class="section-subheading text-muted">Here are your events from ' .$row[User]. ' email.</h3> 
             </div>
         </div>
    <center>
         <!-- MAP DISPLAY GOES HERE!!!!!!!!!!!!!!!!!1 -->

         <!-- Button to display all events and add, edit, or delete any one of them -->
         <form action="http://google.com">
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
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li> <a href="index.html">Unsubscribe</a></h3> 
                        </li>
                        <li><a href="#">Privacy Policy</a>
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



