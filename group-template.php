<?php
session_start();
if(!(isset($_SESSION['email'])))
{
    header("$location: index.php");
}

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";
$name = $_GET['name'];


$name = Trim($name);

$sql = "SELECT groupid,name,description FROM groups WHERE name = '$name';";

//$other_data_query =


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


    //echo $sql;
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

      $groupid = $row['groupid'];
      $newname = $row['name'];
      $purpose = $row['description'];
      //echo $group; echo('!');echo $name; echo('!'); echo $purpose; echo "\n";
    }

    //"SELECT * FROM trips WHERE tripid in (SELECT tripid FROM grouptrips WHERE groupid = '1');"
    //"SELECT * FROM trips WHERE tripid in (SELECT tripid FROM grouptrips WHERE groupid = '6');"
    // $get_trips = "SELECT * FROM trips WHERE tripid in (SELECT tripid FROM grouptrips WHERE groupid = '$groupid');";
    //
    // try {
    //   $stmt = $conn->prepare($get_trips);
    //   $stmt->execute();
    //   $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //
    //   }
    //
    // catch(PDOException $e)
    //   {
    //   echo $get_trips . "<br>" . $e->getMessage();
    //   }
    //
    // foreach($stmt->fetchAll() as $row){
    //
    //   $groupid = $row['location'];
    //   $newname = $row['dates'];
    //   $purpose = $row['description'];
    //   echo $groupid; echo('!');echo $newname; echo('!'); echo $purpose; echo "<br>";
    // }



 echo "<input type='hidden' id='groupid' value=$groupid>";

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
                <li>
                    <a class="nav-link" href="/dashboard.php">
                        <i class="nc-icon nc-chart-bar-32"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="./notifications.html">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li class="nav-item active">
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
                <li>
                    <a class="nav-link" href="./maps.html">
                        <i class="nc-icon nc-pin-3"></i>
                        <p>Maps</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

<!-- Group Creator -->
<div class='new-group'>
  <h4 id = 'Name' class = 'center trip-title'> Group Name </h4>

  <input type='text' name='creation' class = 'trip-input' id = 'Nameinput'>

  <!-- <button type='button' class='another' onclick = 'add_another()'> Add </button> -->
  <div class = 'buttons'>
  <!-- <button class='btn back' onclick="backButton(doWithThisElement(this.id))"> Back </button>
  <button class='btn next' onclick="nextButton()"> Next </button>
  <br> <br> -->
  <button type="button" class='submit' onclick="groupPost()"> Submit </button>
  </div>


</div>

<form class = 'hidden-form' action="new-groups.php" method = 'post' enctype="multipart/form-data" id = "upload-form">
  <input type="text" name="Name">
  <!-- <input type="text" name="Purpose"> -->
</form>


<!-- -->

<!--New Trip Creator -->
<div class='new-trip'>
  <h4 id = 'location' class = 'center trip-title'> Where do you want to go? </h4>
  <form action="php/trip-start.php" method = 'post' enctype="multipart/form-data" id = "upload-form">
  <input type='text' name='creation' class = 'trip-input' id = 'locationinput'>

<!--    <label for="file-upload" class="custom-file-upload">
    <input id='file-upload' type="file" name="file" accept="image/*" multiple onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
    <p>Click to upload an image </p>
    <img id = "output">
  </label> -->

  <!-- <button type='button' class='another' onclick = 'add_another()'> Add </button> -->
  <div class = 'buttons'>

  <!-- <button class='btn back' onclick="backButton()"> Back </button>

  <button class='btn next' onclick="nextButton()"> Next </button>
  <button type="button" class='submit' onclick="tripPost()"> Submit </button>
  <br> <br>
  <button type="button" class='submit' onclick="tripPost()"> Submit </button> -->
  </div>
</form>
<button type="button" class='submitter' onclick="tripPost()"> Submit </button>


</div>

<!-- <form class = 'hidden-form' action="new-trips.php" method = 'post' enctype="multipart/form-data" id = "upload-form">
  <input type="text" name="location">
  <input type="date" name="date-start" id = 'saved-date-start'>
  <input type="date" name="date-end" id = 'saved-date-end'>
  <input type="text" name="pictures">
  <input type="text" name="links">
  <input id='file-upload' type="file" name="file" accept="image/*" multiple>
  <input type="text" name="description">
  <input type="text" name="attendees">
  <input type="text" name="cost">
</form> -->

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
                              <p> All Groups </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p> My Group Trips </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <p id='trip-but' onclick = "makeTrip()"> New Trip </p>
                              <span class="d-lg-none">Dashboard</span>
                          </a>
                      </li>

                  </ul>
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <span class="d-lg-block" contenteditable="true">&nbsp;Find Groups&nbsp;</span>
                            <i class="nc-icon nc-zoom-split"></i>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- TRIPS -->
    <div class="content" data-image="../assets/img/sidebar-5.jpg">
        <div class="container-fluid">
          <div class = 'group-info'>
           <div class = 'headline center'>
             <h1> <?php echo $name;?> </h1>
           </div>

           <div class = 'description center'>
             <p> <?php echo $purpose;?> </p>
           </div>

           <h2 class = 'trips-header center'> Group Trips </h2>
           <div class = 'group-trips'>
             <!--
             <div class = 'indie-trips' id = ${place}>

               <div class = 'trip-info'>
               <span onclick="infoButt('${summary}','${place}')"> <i class="fa fa-info-circle info-butt"></i></span>
                 <span class = 'date'>${date}</span>
                 <h2 class = 'location'>${place}</h2>
               </div>

               <div class = 'bottom-info' id = ${place}>
                 <span class = 'people-going'>${attendees}</span>
                 <progress value=50 max=${total}></progress>
                 <span class = 'total-val'>30 of ${total}</span>
                 <span class = 'pledge'> <input type = 'button' value = 'Pledge' class = 'pledge-b' id = ${place} onclick = "makeDonation(this)"> </input> </span>
               </div>

             </div>`

             -->

             <?php
             $get_trips = "SELECT * FROM trips WHERE tripid in (SELECT tripid FROM grouptrips WHERE groupid = '$groupid');";

             try {
               $stmt = $conn->prepare($get_trips);
               $stmt->execute();
               $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

               }

             catch(PDOException $e)
               {
               echo $get_trips . "<br>" . $e->getMessage();
               }

             foreach($stmt->fetchAll() as $row){

               $location = $row['location'];
               $dates = $row['dates'];
               $description = $row['description'];

               //echo $groupid; echo('!');echo $newname; echo('!'); echo $purpose; echo "<br>";
               echo " <div class = 'indie-trips' onclick = flipcard(this) id = $location>

                         <div class = 'front-card' id = $location>
                           <div class = 'trip-info'>

                             <span class = 'date'>12/29/2018</span>
                             <h2 class = 'location'>$location</h2>
                           </div>

                           <div class = 'bottom-info' id = $location>
                             <span class = 'people-going'>Who knows</span>
                             <progress value=50 max=100></progress>
                             <span class = 'total-val'>30 of 50</span>
                           </div>
                           </div>


                         <div class = 'back-card' id = $location>
                         <div class = 'trip-info'>

                           <span class = 'date'>Cheese</span>
                           <h2 class = 'location'>Flex</h2>
                         </div>

                         <div class = 'bottom-info' id = $location>
                           <span class = 'people-going'>BROOOO</span>
                           <progress value=50 max=50></progress>
                           <span class = 'total-val'>30 of 90</span>
                         </div>
                           </div>
                         </div>
               ";

             }



         ?>


           </div>

           <h2 class = 'trips-header center'> Group Members </h2>
           <div class = 'members'>
             <p> Person 1 </p>
             <p> Person 2 </p>
           </div>

           <h2 class = 'trips-header center'> Interests </h2>
           <div class = 'interests'>
             <ul class = 'group-interests'>
               <li> Rock Climbing </li>
               <li> Skating </li>
               <li> Cheese Festivals </li>
             </ul>
           </div>


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
<script src="../assets/js/groups.js"></script>

<!-- My JS -->
<script type="text/javascript" src='assets/js/new-trips.js'></script>
<script type="text/javascript" src='assets/js/trip-posting.js'></script>


</html>
