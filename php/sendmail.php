<?php



$email = $_POST['email'];

echo "ALIVE";
echo $email;
$email_link = 'http://localhost:8000/forgotpassword.php/'.$email;
// require_once('../PHPMailer/PHPMailerAutload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'hangman.supp@gmail.com';
$mail->Password = 'jibneh82!';
$mail->SetFrom('no-reply@hangman.zone');
$mail->Subject = "Password Reset";
$mail->Body = "<div>
              <p> Hey it looks like you need to reset your password, not a problem! <br>
               Click the link and enter in your new password. </br>
              </p>
              <form action = 'http://localhost:8000/forgotpassword.php' method = 'post'>
              <button name='forgot-email' type='submit' value=$email_link>Lost Password</button>
              </form>
              </div>
              ";
$mail->AddAddress($email);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
 ?>
