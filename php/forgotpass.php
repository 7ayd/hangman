<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";


$email = $_POST['email'];
$postedpass = $_POST['pass'];
$confirmpass = $_POST['pass-confirm'];

echo "POST";
print_r($_PUT);
print_r($_POST);

echo "ALIVE"; echo $email; echo $postedpass; echo $confirmpass; echo "\n";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $sql; echo '<br>';
if($confirmpass == $postedpass){
$sql = "UPDATE login SET password = '$postedpass' WHERE email = '$email';";
echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "Success";
    $_SESSION['username'] = $email;
    $_SESSION['email'] = $email;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else{
  echo "False";
}


$conn->close();

echo "outie";







?>
