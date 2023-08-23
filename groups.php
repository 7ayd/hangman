<?php
session_start();
if(!(isset($_SESSION['email'])))
{
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
<!--    <link rel="apple-touch-icon" sizes="76x76" href="#">
    <link rel="icon" type="image/png" href="#"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Profile</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link href="../assets/css/customcss.css" rel="stylesheet" />
</head>

<body>


  <div class="wrapper">

    <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Hangman
                </a>
            </div>
            <ul class="nav">
                <!-- <li>
                    <a class="nav-link" href="/dashboard.php">
                        <i class="nc-icon nc-chart-bar-32"></i>
                        <p>Dashboard</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a class="nav-link" href="./notifications.html">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>Notifications</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="/userpage.php">
                        <i class="nc-icon nc-circle-09"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="/groups.php">
                        <i class="nc-icon nc-notes"></i>
                        <p>Groups</p>
                    </a>
                </li>
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

<!-- Group Creator -->
<div class='new-group'>
  <h4 id = 'Name' class = 'center trip-title'> Group Name </h4>

  <input type='text' name='creation' class = 'trip-input' id = 'Nameinput'>

  <!-- <button type='button' class='another' onclick = 'add_another()'> Add </button> -->
  <div class = 'buttons'>
  <button class='btn back' onclick="backButton()"> Back </button>
  <button class='btn next' onclick="nextButton()"> Next </button>
  <br> <br>
  <button type="button" class='submit' onclick="groupPost()"> Submit </button>
  </div>


</div>

<form class = 'hidden-form' action="new-groups.php" method = 'post' enctype="multipart/form-data" id = "upload-form">
  <input type="text" name="Name">
  <input type="text" name="Purpose">
</form>


<!-- -->



    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class="container-fluid">

                <a class="navbar-brand" href="#pablo"> </a>
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="nav navbar-nav mr-auto">
                      <!-- <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p> All Groups </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p> My Group Trips </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li> -->
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p id = 'trip-but' onclick = "makeGroup()"> New Group </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>

                  </ul>
                  <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                          <span class="d-lg-block" contenteditable="true">&nbsp;Find Groups&nbsp;</span>
                            <i class="nc-icon nc-zoom-split"></i>

                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
<!-- TRIPS -->
    <div class="content" data-image="../assets/img/sidebar-5.jpg">
        <div class="container-fluid">
           <div class = 'trips'>



           </div>

        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav>
                <ul class="footer-menu">
                    <li>
                        <a href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Company
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Portfolio
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
    </footer>
</div>
</div>

</body>

<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script src="../assets/js/new-group.js"></script>
<script src="../assets/js/group-posting.js"></script>
<script src="../assets/js/group-load.js"></script>


</html>
