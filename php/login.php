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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT password FROM login WHERE email = '$email';";
$result = $conn->query($sql);
//echo $sql; echo "<br>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["password"]."<br>";
        if ($row["password"] == $postedpass){
          echo "True;$email";//echo "<br>";
          $_SESSION["email"] = $email;
          // set_session();



        }
    }
} else {
    echo "0 results";
}

$conn->close();



// function set_session(){
//   $info_query = "SELECT userid,email,username,country,firstname,lastname,phonenum,about from userprofile WHERE email = '$email' limit 1";
//   $result = mysqli_query($conn,$info_query);
//   $value = mysqli_fetch_assoc($result);
//   $userid = $value['userid'];
//   $email = $value['email'];
//   $username = $value['username'];
//   $country = $value['country'];
//   $firstname = $value['firstname'];
//   $lastname = $value['lastname'];
//   $phonenum = $value['phonenum'];
//   $about = $value['about'];
//   print_r($value);
//   // $_SESSION["userid"] = $userid;
//   // $_SESSION["email"] = $email;
//
//   $_SESSION["username"] = $email;
//   $_SESSION["country"] = $country;
//   $_SESSION["firstname"] = $firstname;
//   $_SESSION["lastname"] = $lastname;
//   $_SESSION["phonenum"] = $phonenum;
//   $_SESSION["about"] = $about;
//   $_SESSION["username"] = $email;
//
// }


?>
