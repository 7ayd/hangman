<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";


$email = $_POST['email'];
$postedpass = $_POST['pass'];

//echo $email; echo "<br>";
//echo $postedpass; echo "<br>";

// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $sql; echo '<br>';




//echo $sql; echo "<br>";

if ($conn->query($sql) === TRUE) {
    echo "Success";
    $_SESSION['username'] = $email;
    $_SESSION['email'] = $email;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

class DBobject {
    public $connection = new mysqli($servername, $username, $password, $dbname);
    public $insertFunc = 'insertionfunc';


    function insertionfunc(table,fields**,values**) {
      $sql_statement = (loop )
      $sql = "INSERT INTO login(email,password)
      VALUES('$email', '$postedpass');";
    }
}

$foo = new Foo;


?>
