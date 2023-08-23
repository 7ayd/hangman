<?php
session_start();
if(!(isset($_SESSION['email'])))
{
    header("Location: index.php");
}

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";
$tripid = $_GET['tripid'];
$screename = $_SESSION['username'];

$sql = "SELECT * FROM trips WHERE tripid = $tripid;";
$linkgrab = "SELECT * FROM linktable WHERE tripid = $tripid;";
$peoplegrab = "SELECT * FROM tripuser WHERE TRIPID = $tripid;";

$folder = "trip-images/$tripid";
$dir = "trip-images/$tripid/*";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
catch(PDOException $e)
  {
  echo $sql . "<br>" . $e->getMessage();
  }

  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  foreach($stmt->fetchAll() as $row){

    $location = $row['location'];
    $dates = $row['dates'];
    $pictures = $row['pictures'];
    $description = $row['description'];
    $cost = $row['cost'];
    $contributed = $row['contributed'];

  }

/////

$link_array = array();
try {
  $stmt = $conn->prepare($linkgrab);
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  }


catch(PDOException $e)
  {
  echo $linkgrab . "<br>" . $e->getMessage();
  }


foreach($stmt->fetchAll() as $row){
  array_push($link_array,$row['link']);
}

  echo "<input type='hidden' id='tripid' value=$tripid>";
  echo "<input type='hidden' id='uname' value = $screename>";

$map_location = "https://maps.google.com/maps?q=";
$map_ending = "&t=&z=13&ie=UTF8&iwloc=&output=embed";
$map_url = $map_location . $location . $map_ending;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Trip Page</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="../assets/css/customcss.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto&display=swap" rel="stylesheet">
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
                          <a href="#" class="nav-link">
                              <p id='trip-but' onclick = "editTrip(this)"> Edit Trip </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>
                      <li class = "nav-item">
                        <a href="#jumppoint" class="nav-link" onclick = "displayEdits()">
                            <p id='trip-but'> Planning </p>
                            <span class="d-lg-none">Dashboard</span>
                        </a>
                    </li>
                  </ul>
                  <ul class="navbar-nav ml-auto">
                </ul>
            </div>
        </div>
    </nav>
<!-- TRIPS -->
<div class='new-trip'>
  <h4 id = 'location' class = 'center trip-title'> Where do you want to go? </h4>
  <input type='text' value = <?php echo $location ?> name='creation' class = 'trip-input' id = 'locationinput'>
  <div class = 'buttons'>
    <button class='btn back' onclick="backButton()"> Back </button>
    <button class='btn next' onclick="nextButton()"> Next </button>
    <br> <br>
    <input type="submit" class='box-style submit' onclick="tripPost(<?php echo $tripid ?>)">
  </div>
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
  <div class="content" data-image="../assets/img/sidebar-5.jpg">
      <div class="container-fluid">
          <div class = 'trip-page'>
            <div class = 'cost-calc'>
              <button onclick = "calcCost()">Close </button>
              <h1 class = 'cost-title center'> Cost calculator </h1>
              <div class = 'cacl-questions'>
                <p class = "cost-font"> Travel Cost = Getting there + Getting back </p>
                <input id = 't-cost' class = 'cost-input' name = 't-cost' type = 'text' placeholder="Estimate"/>
                <p class = "cost-font"> Accomodations = cost per night x nights</p>
                <input id = 'a-cost' class = 'cost-input' name = 'a-cost' type = 'text' placeholder="Estimate"/>
                <p class = "cost-font"> Transportation = cost per day x days</p>
                <input id = 'transpo-cost' class = 'cost-input' name = 'transpo-cost' type = 'text' placeholder="Estimate"/>
                <p class = "cost-font"> Food & Drink = (avg meal cost x meals per day + avg meal cost x 25%) x days</p>
                <input id = 'fd-dk-cost' class = 'cost-input' name = 'fd-dk-cost' type = 'text' placeholder="Estimate"/>
                <p class = "cost-font"> Activities = average activitie cost x avg activities per day  </p>
                <input id = 'act-cost' class = 'cost-input' name = 'act-cost' type = 'text' placeholder="Estimate"/>
                <p class = "cost-font">Miscellaneous: Memoribilia, gifts, tipping</p>
                <input id = 'misc-cost' class = 'cost-input' name = 'misc-cost' type = 'text' placeholder="Estimate"/>
              </div>
              <h4 id = 'calc-total' class = 'calc-total'> Total: </h4>
              <input type="submit" id = "calc-submit" class="box-style" onclick = calcSubmit()>
            </div>
            <div class = 'header-data'>
              <h1 onclick = 'editLocation(this)' class = 'location changeable'> <?php echo $location ?> </h1>
              <h4 onclick = 'editDates(this)' class = 'date changeable'> <?php echo $dates ?> </h4>
            </div>
              <div class = 'center mapouter'>
                  <div class="gmap_canvas">
                    <iframe width='100%' height='100%' id="gmap_canvas" src="<?php echo $map_url ?>"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                  </div>
                </div>
            <div class = 'trips-data'>
              <div class = 'center description'>
                <br>
                <br>
                <p class = 'changeable'>
                   <?php echo $description ?></p>
              </div>
              <div id = 'jumppoint' class='trips-content'>
                <div>
                  <button class = 'btn editable' onclick = "addPictures(this)">Add Pictures</button>
                  <div class = 'image-hide'>
                    <div class = 'image-upload'>
                      <div class = 'radio-check'>
                        <div id = 'url-radio'>
                          <label for="urlRadio">Url</label>
                          <input type="radio" id="urlRadio" name="drone" value="urlRadio" checked>
                        </div>
                        <div id = 'file-radio'>
                          <label for="imgFile">File</label>
                          <input type="radio" id="imgFile" name="drone" value="imgFile">
                        </div>
                      </div>
                      <label for="image-upload" class="custom-file-upload">
                        Custom Upload
                      </label>
                      <input id = 'image-upload' type="file" name="files[]" accept="image/*" multiple>
                      <input id = 'url-upload' type="text" placeholder = "URL">
                      <input type = "submit" id = 'prof-submit' class = "box-style" onclick = 'submitImage()'>
                    </div>
                  </div>
                  <h4> Pictures </h4>
              </div>
              <div class = 'image-wheel'>
                  <?php foreach(glob($dir) as $file)
                   {echo "<img class = 'trip-image-n' src = $file>";}?>
                </div>
            </div>
              <div class = 'trips-content'>
                <div>
                <button class = 'btn editable' id = 'linksinputsubmit' onclick = "toggleInput(this.id)">Add Links</button>
                <h4> Links </h4>
                <input type = 'text' placeholder="Enter complete link with HTTP(S)" id = 'linksinputs' name = 'input-add'/>
                <input onclick = "submitLink(this)" id = 'linksubmit' type="submit" class='box-style' onclick="tripPost()">
                </div>
                <div class = 'flex-row links-wheel'>
                  <?php foreach($link_array as $link){
                    echo "<li> <a href = $link> $link </a> </li>";}?>
                </div>
              </div>
              <div class = 'flex-row'>
                <p class = 'changeable'> Cost: <?php echo $cost ?> </p>
              </div>
            </div>
            <a onclick = "calcCost()" href='#navigation'><button id = "cost-button" class = 'btn editable'>Calculate Cost</button></a>
          </div>
      </div>
  </div>
</div>
</div>

</body>

<script src="js/vendor/jquery.3.2.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="../assets/js/trip-edit.js"></script>
</html>
