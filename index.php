<?php
session_start();
if(isset($_SESSION['email']))
{
    header("Location: userpage.php");
}
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
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto&display=swap" rel="stylesheet">
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap1.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#primary-menu">
    <!--Mainmenu-area-->
    <div class ='head' data-spy="affix" data-offset-top="100">
        <div class="container">
            <!--Logo-->
            <div class="navbar-header">
                <a href="#" class="navbar-brand logo">
                    <h2 class ='site-title'>Hangman</h2>
                </a>
            </div>

            <nav class="style = collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li onclick = 'login_box()'><a class ='navylink' href="#faq-page"> Enter </a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!--Mainmenu-area/-->
    <div class = 'login-box'>
      <div class = 'top-login'>
        <i class = 'exit-icon ti-close' onclick = 'close_out()'> </i>
        <h1 class='login-title center'> Sign In </h1>
      </div>
      <form id = 'signin' class = 'login-post'>
        <input type = 'text' name = 'email' class = 'login-email' placeholder="Email">
        <input type = 'password' name = 'pass' class = 'login-password' placeholder="Password">
        <input type = 'submit' class = 'login-submit' onclick = 'checkPassword()'>
      </form>
      <div class = 'login-footer help'>
        <button class="button-forgot" onclick = "open_sign()">Don't have an account? Sign up </button>
        <button class="button-forgot" onclick = "forgot_pass()">Forgot password? Contact me to reset it</button>
      </div>
    </div>

    <header class="header-area full-height relative v-center" id="home-page">
        <div class="absolute anlge-bg"></div>
        <div class="container">
            <div class="row v-center">
                <div class="col-md-6 header-text">
                    <h2>Where do you want to go?</h2>
                    <p>
                      Build out trips in your private wishlist or to share with all,
                      Reach out to people for trips you're interested in joining!
                    </p>
                    <a href="#" class="button white" onclick = 'open_sign()'>Sign up</a>
                    <a href="#" class="button white" onclick = 'betaLogIn()'>Beta Entrance</a>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-icon">
                            <img src="images/bucketdrawing1.png" alt="">
                        </div>
                        <h4>Bucket List</h4>
                        <p>Fill out your private bucket list with the places you want to visit. Or create trips in the public trips page for all to see.
                           Connect with people that proposed an interesting trip and coordinate.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="card-body">
      <div class = 'top-login'>
        <i class = 'exit-icon ti-close' onclick = 'close_sign()'> </i>
        <h1 class='login-title center'> Sign Up </h1>
      </div>
        <form id = 'sign-up' class = 'login-post'>
          <input type = 'text' name = 'email' class = 'login-email' placeholder="Email">
          <input type = 'password' name = 'pass' class = 'login-password' placeholder="Password">
          <input type = 'password' name = 'pass-confirm' class = 'login-password' placeholder="Confirm Password">
          <input type = 'submit' class = 'login-submit' onclick = 'signUp()'>
        </form>
    </div>

    <div class = 'pass-box'>
      <div class = 'top-login'>
        <i class = 'exit-icon ti-close' onclick = 'close_pass()'> </i>
        <h1 class='login-title center'> Forgot Password </h1>
      </div>
      <div id = 'passforgot' class = 'forgot-post'>
        <input type = 'text' name = 'passf-email' class = 'login-email' placeholder="Email">
        <input type = 'submit' class = 'login-submit' onclick = 'forgotPass()'>
      </div>
    </div>

</body>
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/addedjs.js"></script>
</html>
