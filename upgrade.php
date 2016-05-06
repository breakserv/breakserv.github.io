<html>
<head>
<title>BreakServ - Membership Upgrade</title>
</head>
<BODY BGCOLOR="#313131" TEXT = "white">

<?php
      //get variables
      $user = $_POST["User"];
      $pass = $_POST["Pass"];

      include ("readDb.php");
      //get variables from readDB.php
      //add users now
      if ($found != 0){
echo "<html>";
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
                 <div class="intro-heading"><img src="http://atian.mycpanel2.princeton.edu/breakserv/img/BSLogo.png" width=80%></div>';
                    echo '<BR><BR><h3 class="service-heading text-muted">For a limited time, get a FREE upgrade to Premium!</h3>
                  <form action="upgradefree.php" method="post">';
                  echo "<input type='hidden' name='User' value=$user />";
                  echo "<input type='hidden' name='Pass' value=$pass />";
                  echo '<button type="submit" class="btn btn-xl">Free Upgrade</button>
                  </form><BR><BR>';
                  echo '<BR><h4 class="service-heading text-muted">After this promotion ends, Premium will cost $20 for a lifetime subscription.</h4>';
                    echo '<form action="/charge" method="POST">
                          <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_iNgxYIF5AAdgI16GaRCxzkh1"
                            data-amount="2000"
                            data-name="BreakServ"
                            data-description="2 widgets"
                            data-image="http://i.imgur.com/ziFeCww.png"
                            data-locale="auto"
                            data-zip-code="true">
                          </script>
                        </form>';
                  echo '<BR><BR><BR><BR><BR>
                  <form action="login.php" method="post">';
                  echo "<input type='hidden' name='User' value=$user />";
                  echo "<input type='hidden' name='Pass' value=$pass />";
                  echo '<button type="submit" class="btn btn-xl">Home</button>
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
      } else {
      		echo "<br><br><br><br><br><center><h1>Cannot read the database. Logging you out. </h1></center>";
          echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.html">';
     	}
 ?>

