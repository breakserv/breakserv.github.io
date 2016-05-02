<html>
<head>
<title>Unsub from BreakServ</title>
</head>
<BODY BGCOLOR="#313131" TEXT = "white">

<?php

      //get variables
      $user = $_POST["User"];
      $pass = $_POST["Pass"];
      $secretpass = $_POST["SecretPass"];

      if(!$pass){

// ***********************************************************************
// TEMPLATE FROM http://startbootstrap.com/template-overviews/agency/ 
// ***********************************************************************

echo "<head>";
    
    echo "<meta charset='utf-8'>";
    echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo '<meta name="description" content="">';
    echo '<meta name="author" content="">';

    echo " <title> Delete Account</title>";
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


    <!-- Main Page -->
    <section id="homepage">
    <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="intro-heading"><img src="http://atian.mycpanel2.princeton.edu/breakserv/img/BSLogo.png" width=80%></div>
                 <h2 class="section-heading">Unsubscribe</h2>

                  <BR><BR><h3 class="service-heading text-muted">Are you sure you want to delete your account?</h3>
                  <h3 class="section-subheading text-muted">Please note that if you are a Premium user and terminate your account, <BR>you will have to re-register for Premium if you create a new account afterwards.</h3>
                  <h3 class="service-heading text-muted">Please confirm your password below:</h3>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <form action="unsub.php" method="post">
                            <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password *" name="Pass" required data-validation-required-message="Please enter your password.">';
                            echo "<input type='hidden' name='User' value=$user /><BR>";
                            echo "<input type='hidden' name='SecretPass' value=$secretpass />";
                            echo '<button type="submit" class="btn btn-xl">Unsubscribe</button> 
                    </form>
                </div>
            </div><BR>.<BR>.

            <h3 class="service-heading text-muted">No, I want to keep my account.</h3>';
            echo '<!-- Go back to login homepage -->
            <form action="login.php" method="post">';
            echo "<input type='hidden' name='User' value=$user />";
            echo "<input type='hidden' name='Pass' value=$secretpass />";
            echo '<button type="submit" class="btn btn-xl">Go back Home</button>
            </form>

            </div>
            </div>
            </div>
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

</body>s</html>';
      }

      else{

           //get variables from readDB.php
           include ("readDb.php");

	   if ($pass == $passdB) {
               include ("connectDb.php");

               $sql1 = "DELETE FROM Members WHERE User = '$user'"; 
               $sql2 = "DELETE FROM Events WHERE eUser = '$user'"; // delete from both databases 

               $result = mysql_query($sql1);
               $result2 = mysql_query($sql2);
               if (!result)
	           echo ' <br><br><br><br><br><center><h1> <font color="red"> <b><i> Error. Please Try Again. </b></i></font> </h1> </center>';
               else
	           echo '<br><br><br><br><br><center><h1> Unregistered from BreakServ. We hope you will reconsider us in the future! </font></h1></center>';
	       echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.html">';
	       echo '</html>';

               mysql_close($conn);
         }

	 else {
	      echo '<br><br><br><br><br><center><h1>Password incorrect. Please try again. You will be redirected back home momentarily</h1></center>';
              sleep(3);
              echo '<form id="autologin" action="login.php" method="post">';
              echo "<input type='hidden' name='User' value=$user />";
              echo "<input type='hidden' name='Pass' value=$passdB />";
              echo '</form>';
              echo '<script language="javascript">';
              echo 'document.getElementById("autologin").submit();';
              echo '</script>';
	      echo '</html>';
         }
      }

?>
