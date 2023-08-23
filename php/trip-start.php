<?php

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";




try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//  echo "WE OUT HERE";

  $sql = "SELECT location,dates,links,description,attendees,cost FROM trips;";
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


  // $query_array = $stmt->fetchAll();
  // echo "<br> Break <br> ";
  // echo sizeof($query_array);
  // var_dump($query_array);
  // echo "<br> Break <br> ";
  // var_dump($stmt->fetchAll());
  // echo "<br> Break <br> ";
  foreach($stmt->fetchAll() as $row){
    $location = $row['location'];
    $dates = $row['dates'];
    $links = $row['links'];
    $description = $row['description'];
    $attendees = $row['attendees'];
    $cost = $row['cost'];
    echo $location; echo('!'); echo $dates; echo('!'); echo $links; echo('!');
    echo $description; echo('!'); echo $attendees; echo('!'); echo $cost; echo "\n";
  }
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $location = $_POST['location'];
  $location = str_replace(' ','-', $location);
  $publicstatus = $_POST['publicstatus'];
  $userid = $_POST['userid'];




    $sql = "INSERT INTO trips(location,creatorid)
        VALUES ('$location',$userid);";
    // echo $sql;
    try {
      // use exec() because no results are returned
      $conn->exec($sql);
      $tripid = $conn->lastInsertId();
      }

    catch(PDOException $e)
      {
      echo $sql . "<br>" . $e->getMessage();
      }

   // $nextsql = "INSERT INTO grouptrips(tripid,groupid)
   //            VALUES ($tripid,$groupid);";
   //  try{
   //    $conn->exec($nextsql);
   //  }
   //
   //  catch(PDOException $e)
   //  {
   //    echo $sql . "<br>>" . $e->getMessage();
   //  }

   $publictripssql = "INSERT INTO publictrips(tripid,public)
              VALUES ($tripid,$publicstatus);";
    try{
      $conn->exec($publictripssql);
    }

    catch(PDOException $e)
    {
      echo $sql . "<br>>" . $e->getMessage();
    }



echo $tripid;

};

?>
