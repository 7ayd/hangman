<?php
session_start();
if(!(isset($_SESSION['email'])))
{
    header("Location: index.php");
}
$userid = $_SESSION['userid'];

 echo "<input type='hidden' name='publicid' value=1>";
 echo "<input type='hidden' name='useridhide' value=$userid>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Trips</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto&display=swap" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="../assets/css/customcss.css" rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <div class="sidebar" data-color = "red" data-image="">
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
                <li>
                    <a class="nav-link" href="/trips.php">
                        <i class="nc-icon nc-globe-2"></i>
                        <p>Trips</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--New Trip Creator -->
    <div class='new-trip'>
      <h4 id = 'location' class = 'center trip-title'> Where do you want to go? </h4>
      <input type='text' name='creation' class = 'trip-input' id = 'locationinput'>
      <input type="submit" class='box-style' onclick="tripPost()">
    </div>

    <form class = 'hidden-form' action="new-trips.php" method = 'post' enctype="multipart/form-data" id = "upload-form">
      <input type="text" name="location">
      <input type="date" name="date-start" id = 'saved-date-start'>
      <input type="date" name="date-end" id = 'saved-date-end'>
      <input type="text" name="pictures">
      <input type="text" name="links">
      <input id='file-upload' type="file" name="file" accept="image/*" multiple>
      <input type="text" name="description">
      <input type="text" name="attendees">
      <input type="text" name="cost">
    </form>

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
                      <li class="nav-item">
                          <a onclick = "makeTrip(<?php echo $userid; ?>)" class="nav-link">
                              <p id='trip-but'> New Trip </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>
                  </ul>
            </div>
        </div>
    </nav>
    <div class="content" data-image="../assets/img/sidebar-5.jpg">
        <div class="container-fluid">

            <div class = 'trips'>

        </div>

        </div>
    </div>
</div>
</div>

</body>

<script src="js/vendor/jquery.3.2.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script type="text/javascript" src='assets/js/page-load.js'></script>
<script type="text/javascript" src='assets/js/new-trips.js'></script>
<script type="text/javascript" src='assets/js/trip-posting.js'></script>

</html>
