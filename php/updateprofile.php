<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";


//Update Profile called

//User has never set profile data

//Grab all data and insert into userprofile table

//Update proflie called

//User has already udpated some elements before

//Take the changed element and make a query to update that value

//$_SESSION['email'] = $email;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_SESSION['email'];

$user_id_query = "SELECT userid,username,email,country,firstname,lastname,phone,about FROM userprofile WHERE email = '$email';";
$result = mysqli_query($conn,$user_id_query);

$value = mysqli_fetch_assoc($result);

$userid1 = $value['userid'];
$screenname1 = $value['username'];
$email1 = $value['email'];
$country1 = $value['country'];
$fnname1 = $value['firstname'];
$lnname1 = $value['lastname'];
$phonenum1 = $value['phone'];
$about1 = $value['about'];

echo "HERE <br>";echo $userid1; echo $screenname1; echo $email1; echo $country1; echo $fnname1;
echo $lnname1; echo $phonenum1; echo $about1; echo " ";
echo strlen($oldscreenname); echo "<br>";


$real_id_query = "SELECT userid FROM login WHERE email = '$email';";
$id_result = mysqli_query($conn,$real_id_query);

$id_value = mysqli_fetch_assoc($id_result);

$userid = $id_value['userid'];
echo "otherid: "; echo $userid; echo "<br>";
//TODO// Input Validation, does everything get updated at once?
//Are correct values being added
echo "RIGHT HERE <br>";

$screenname = $_POST['Username'];
$email_post = filter_var($_POST['Email_address'],FILTER_VALIDATE_EMAIL);
$country = $_POST['Country'];
$fnname = $_POST['First_Name'];
$lnname = $_POST['Last_Name'];
$phonenum = $_POST['Phone_Number'];
$about = $_POST['About_Me'];


echo $screenname; echo $email; echo $country; echo $fnname; echo $lnname; echo $phonenum; echo $about; echo "<br>";


//If its coming from post request, because update_profile called with post

//If its coming from refreshing the page access variables and set _SESSION[COUNTRY] = $COUNTRY







//Get Whats Currently their profile data



if($userid1){
  $update_query = "UPDATE userprofile SET username='$screenname',
   country = '$country', firstname = '$fnname', lastname = '$lnname', phone ='$phonenum',about= '$about'
  WHERE email='$email';";
  if ($conn->query($update_query) === TRUE){
    echo "Updated correctly";
    $_SESSION['username'] = $screenname;
    $_SESSION['email'] = $email;
    $_SESSION['screenname'] = $screenname;
    $_SESSION['phonenum'] = $phonenum;
    $_SESSION['country'] = $country;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
  }
}
else{
  echo "First time and user needs to update profile";
  $sql = "INSERT INTO userprofile(userid,username,email,country,firstname,lastname,phone,about)
  VALUES($userid,'$screenname','$email','$country','$fnname','$lnname','$phonenum','$about');";

  echo $sql; echo "<br>";

   if ($conn->query($sql) === TRUE) {
       echo "Success";
       $_SESSION['username'] = $screenname;
       $_SESSION['email'] = $email;
       $_SESSION['screenname'] = $screenname;
       $_SESSION['phonenum'] = $phonenum;
       $_SESSION['country'] = $country;
       $_SESSION['firstname'] = $firstname;
       $_SESSION['lastname'] = $lastname;

   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }
}



//




$conn->close();
?>
