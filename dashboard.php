<?php
session_start();
if(!(isset($_SESSION['email'])))
{
    header("Location: index.php");
}


$userid = $_SESSION['userid'];

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

echo "<input type='hidden' name='publicid' value=0>";
echo "<input type='hidden' name='useridhide' value=$userid>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
<!--    <link rel="apple-touch-icon" sizes="76x76" href="#">
    <link rel="icon" type="image/png" href="#"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>My Trips</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bisher Added
    <link rel='stylesheet' href = '../assets/css/bootstrap-4.3.1-dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
-->

    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link href="../assets/css/customcss.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto&display=swap" rel="stylesheet">
</head>

<body>


  <div class="wrapper">
    <div class="sidebar" data-color = 'red' data-image="">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                    Hangman
                </a>
            </div>
            <ul class="nav">
                <li>
                    <a class="nav-link" href="/dashboard.php">
                        <i class="nc-icon nc-send"></i>
                        <p>My Trips</p>
                    </a>
                </li>
                <!-- <li>
                    <a class="nav-link" href="./notifications.html">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>Notifications</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/userpage.php">
                        <i class="nc-icon nc-circle-09"></i>
                        <p>User Profile</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a class="nav-link" href="/groups.php">
                        <i class="nc-icon nc-notes"></i>
                        <p>Groups</p>
                    </a>
                </li> -->
                <li>
                    <a class="nav-link" href="/trips.php">
                        <i class="nc-icon nc-globe-2"></i>
                        <p>Trips</p>
                    </a>
                </li>
                <!-- <li>
                    <a class="nav-link" href="./maps.html">
                        <i class="nc-icon nc-pin-3"></i>
                        <p>Maps</p>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class="container-fluid">

                <a class="navbar-brand"> </a>
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="nav navbar-nav mr-auto">
                      <!-- <li class="nav-item">
                          <a href="#" class="nav-link" data-toggle="dropdown">
                              <p> All Groups </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li> -->

                      <!-- <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p> My Group Trips </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li> -->

                      <li class="nav-item">
                          <a onclick = "makeTrip(<?php echo $_SESSION['userid']?>)" class="nav-link">
                              <p id='trip-but'> New Trip </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>
                      <!-- <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p> New Group </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li> -->


                  </ul>
                  <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                          <span class="d-lg-block" contenteditable="true">&nbsp;Find Groups&nbsp;</span>
                            <i class="nc-icon nc-zoom-split"></i>

                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="/userpage.php" class="nav-link">
                          <span class="d-lg-block" contenteditable="true">&nbsp;User Profile&nbsp;</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class='new-trip'>
      <h4 id = 'location' class = 'center trip-title'> Where do you want to go? </h4>
      <form action="php/trip-start.php" method = 'post' enctype="multipart/form-data" id = "upload-form">
        <input type='text' name='creation' class = 'trip-input' id = 'locationinput'>
      </form>
      <input id = <?php echo $userid; ?> type="submit" class='box-style' onclick="tripPost()">
    </div>

<!-- TRIPS -->
    <div class="content" data-image="">
        <div class="square container-fluid">
          <!-- <div class = 'square-member trips-attending'>
            <h4 class= 'center'> Preparing </h4>
          </div> -->
          <h4 class= 'wish-title center'> Bucket List </h4>
          <div class = 'trips'>


              <?php

              $get_trips = "SELECT * FROM trips WHERE creatorid = $userid;";
              try {
                $stmt = $conn->prepare($get_trips);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                }

              catch(PDOException $e)
                {
                echo $get_trips . "<br>" . $e->getMessage();
                }
                $this_row = $stmt->fetchAll();
                $this_row = array_reverse($this_row);
                foreach($this_row as $row){

                  $location = $row['location'];
                  $dates = $row['dates'];
                  $description = $row['description'];
                  $tripid = $row['tripid'];

                  $tripid_mod = 'trip-'.$tripid;


                  //echo $groupid; echo('!');echo $newname; echo('!'); echo $purpose; echo "<br>";

                  echo "
                          <div class = 'indie-trips'>

                              <div class = 'front-card' id = $tripid_mod>


                                <div class = 'trip-info'>
                                  <div class='squish'>

                                    <h2 class = 'location'><a class = 'center' href = /trip-page.php?tripid=$tripid> $location </a></h2>
                                  </div>
                                    <img class = 'display-image' src = 'trip-images/$tripid/trip-image0.png' onerror='this.style.display = \"none\"'\">
                                </div>

                              </div>

                            </div>
                  ";

                }



          ?>



          </div>

          <!-- <div class = 'square-member groups'>
            <h4 class= 'center'> Interesting things going on around you </h4>
          </div>

          <div class = 'square-member metrics'>
            Deals
            How much it costs to do your entire bucket list
            Interesting things
            Groups you might be interested in
            People you might be interested in
          </div> -->


        </div>
    </div>
    <!-- <footer class="footer">
        <div class="container-fluid">
            <nav>
                <ul class="footer-menu">
                    <li>
                        <a href="#">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            What
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Why
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Blog
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
    </footer> -->
</div>
</div>

</body>

<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>

<!-- <script src="../assets/js/jquerfile.js" type = "text/javascript"></script> -->

<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<!-- Chartist Plugin -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin
<script src="../assets/js/plugins/bootstrap-notify.js"></script>  -->
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
 <script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="../assets/js/demo.js"></script> -->





<!-- Adding My Scripts -->

<script type="text/javascript" src='assets/js/new-trips.js'></script>
<script type="text/javascript" src='assets/js/trip-posting.js'></script>

</html>
