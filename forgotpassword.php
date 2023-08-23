<?php
$email = $_POST['forgot-email'];
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Home</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="../assets/css/customcss.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/themify-icons.css">

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#primary-menu">

    <div class="preloader">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>

    <div class="card-hobby">

      <div class = 'top-bobin'>
      <!-- <i class = 'exit-icon ti-close' onclick = 'close_sign()'> </i> -->
        <h1 class='login-title center'> Enter Password </h1>
      </div>
      <div id = 'forgot-p-form' class = 'form-data login-post'>
        <input type = 'password' name = 'pass' class = 'login-password' placeholder="Password">
        <input type = 'password' name = 'pass-confirm' class = 'login-password' placeholder="Confirm Password">
        <input type = 'hidden' name ='email' value = <?php echo $email; ?> >
        <button class = 'login-submit' onclick = 'newPassword()'> Submit </button>
      </div>
    </div>



    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <!--Plugin-JS-->
    <script src="js/owl.carousel.min.js"></script>
<!--    <script src="js/contact-form.js"></script>  -->
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/scrollUp.min.js"></script>
    <script src="js/magnific-popup.min.js"></script>
    <script src="js/wow.min.js"></script>
    <!--Main-active-JS-->

    <script src="js/main.js"></script>
    <script src="js/addedjs.js"></script>
</body>

</html>
