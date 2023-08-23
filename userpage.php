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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$user_id_query = "SELECT userid,username,email,country,firstname,lastname,phone,about FROM userprofile WHERE email = '$email';";

$result = mysqli_query($conn,$user_id_query);

$value = mysqli_fetch_assoc($result);


$userid = $value['userid'];
$screenname = $value['username'];
$country = $value['country'];
$fnname = $value['firstname'];
$lnname = $value['lastname'];
$phonenum = $value['phone'];
$about = $value['about'];

$profile_pic_query = "SELECT picturepath FROM profilepictures WHERE userid = $userid;";

$result = mysqli_query($conn,$profile_pic_query);

if($result){
$value = mysqli_fetch_assoc($result);
};
$profile_pic_path = $value['picturepath'];


$_SESSION['email'] = $email;
$_SESSION['username'] = $screenname;
$_SESSION['phonenum'] = $phonenum;
$_SESSION['country'] = $country;
$_SESSION['firstname'] = $fnname;
$_SESSION['lastname'] = $lnname;
$_SESSION['phonenum'] = $phonenum;
$_SESSION['about'] = $about;
$_SESSION['userid'] = $userid;



$conn->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Profile</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

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
                              <a class="nav-link">
                                <button onclick = 'edit_profile()' type="submit" class="btn">Edit Profile</button>
                                  <span class="d-lg-none">Dashboard</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <span class="no-icon" onclick = 'log_out()'>Log out</span>

                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
          <!-- End Navbar -->
          <div class="content">
              <div class="container-fluid">
                  <div class="row">
                    <div class = 'col-md-1'>
                    </div>
                    <div class="col-md-10">
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
                          <div class = 'input-upload'>
                          <label for="file-upload" class="custom-file-upload">
                            Custom Upload
                          </label>
                          <input id = 'file-upload' type="file" name="file" accept="image/png,image/jpeg" onchange="document.getElementById('big-image').src = window.URL.createObjectURL(this.files[0])">
                          <input id = 'url-upload' type="text" placeholder = "URL">

                          <button id = 'prof-submit' onclick = 'submitImage()'/>Submit</button>
                        </div>
                      </div>
                    </div>

                      <div class="card">
                        <div class="card-header">
                          <div class="author">
                            <a onclick = 'expand_image()' href="#">
                              <img id = 'small-image' class="other-pic border-gray" src="<?php echo $profile_pic_path ?>" onerror="this.src='../assets/img/faces/face-0.jpg'">
                            </a>
                            <a onclick = 'expand_image()' href ="#">
                              <img id = 'big-image' class="big-avatar border-gray" src="<?php echo $profile_pic_path ?>" onerror="this.src='../assets/img/faces/face-0.jpg'">
                            </a>
                            </div>
                        </div>

                          <div class="card-body">
                              <form>
                                  <div class="row">
                                      <div class="px-1">
                                      </div>
                                      <div class="col-md-4 px-1">
                                          <div class="form-group">
                                              <label>Username</label>
                                              <p class="user-control"><?php echo $_SESSION['username'];?> </p>
                                              <input type="text" class="form-control" placeholder="Username" value = "<?php echo $_SESSION['username'];?>">
                                          </div>
                                      </div>

                                      <div class="col-md-4 pl-1">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Email address</label>
                                              <p class="user-control"><?php echo $_SESSION['email'];?></p>
                                              <input type="email" class="form-control" placeholder="Email" value = "<?php echo $_SESSION['email'];?>">
                                          </div>
                                      </div>
                                      <div class="col-md-3 px-1">
                                          <div class="form-group">
                                              <label>Country</label>
                                              <p class="user-control"> <?php echo $_SESSION['country'];?></p>
                                              <input type="text" class="form-control" placeholder="Country" value = "<?php echo $_SESSION['country'];?>">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-4 pr-1">
                                          <div class="form-group">
                                              <label>First Name</label>
                                              <p class="user-control"> <?php echo $_SESSION['firstname'];?></p>
                                              <input type="text" class="form-control" placeholder="First Name" value = "<?php echo $_SESSION['firstname'];?>">
                                          </div>
                                      </div>
                                      <div class="col-md-4 pl-1">
                                          <div class="form-group">
                                              <label>Last Name</label>
                                              <p class="user-control"><?php echo $_SESSION['lastname'];?></p>
                                              <input type="text" class="form-control" placeholder="Last Name" value = "<?php echo $_SESSION['lastname'];?>">
                                          </div>
                                      </div>
                                      <div class="col-md-3 pr-1">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <p class="user-control"> <?php echo $_SESSION['phonenum'];?> </p>
                                                <input type="text" class="form-control" placeholder="Phone Number" value = "<?php echo $_SESSION['phonenum'];?>">
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label>About Me</label>
                                              <p class="user-control"> <?php echo $_SESSION['about'];?></p>
                                              <textarea rows="4" cols="80" class="form-control" value="Mike"><?php echo $_SESSION['about'];?></textarea>
                                          </div>
                                      </div>
                                  </div>
                                  <button type="submit" onclick = 'update_profile()' class="form-control btn btn-info btn-fill pull-right">Update Profile</button>
                                  <div class="clearfix"></div>
                              </form>
                          </div>
                        </div>
                      </div>
                      <div class = 'col-md-2'>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  </body>
  <script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
  <script src="../assets/js/userpage.js"></script>
  <?php echo "<input type='hidden' id='userid' value=$userid>" ?>
  </html>
