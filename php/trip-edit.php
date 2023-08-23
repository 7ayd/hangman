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

    // $sql = "SELECT location,attendees,cost FROM trips;";



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
  $actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
  $coming_from =  $_SERVER['REQUEST_URI'];
  $uri_array = explode ("/", $coming_from);
  $url_portion = $uri_array[3];
  echo $actual_link; echo "<br>"; echo $_SERVER['REQUEST_URI']; echo "<br>";  echo $url_portion;


if($url_portion == 'calcsubmit'){
  echo "WE ARE IN HERE"; echo "<br>";
  $cost = $_POST['total'];
  $tripid = $_POST['tripid'];
  echo "TRIPID:";echo $tripid;
  echo "<br>";
  echo "COST:";echo $cost;
  echo "<br>";
  $sql = "UPDATE trips SET cost = $cost WHERE tripid = $tripid;";
  echo $sql; echo "<br>";
  try {
    // use exec() because no results are returned
    $conn->exec($sql);
    //$tripid = $conn->lastInsertId();
    echo "Success";
    }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

}

if($url_portion == 'peoplelinks'){

  // $tripid = $_POST['location'];
  // $location = str_replace(' ','-', $location);
  $groupid = $_POST['groupid'];
  $link = $_POST['links'];
  $people = $_POST['people'];
  // $new_data = $_POST['data'];
  $tripid = $_POST['tripid'];
  $username = $_POST['username'];

  echo "Tripid:";echo $tripid; echo "Links:";echo $links; echo "People:"; echo $people; echo "Break";



  // if($people != 'undefined!'){
  //   echo "in here actually";
  //   $sql = "INSERT INTO tripuser(userid,tripid,companions) VALUES ('$username',$tripid);";
  //   echo $sql;
  // }

  if($link != 'undefined'){

    echo "in here";

    $sql = "INSERT INTO linktable(tripid,link) VALUES($tripid,'$link');";

    echo $sql;

  }
//
    try {
      // use exec() because no results are returned
      $conn->exec($sql);
      //$tripid = $conn->lastInsertId();
      echo "Success";
      }

    catch(PDOException $e)
      {
      echo $sql . "<br>" . $e->getMessage();
      }

}

if($url_portion == 'updateData'){
  echo "WE ARE IN HERE"; echo "<br>";
  $location = $_POST['location'];
  $dates = $_POST['dates'];
  $tripid = $_POST['tripid'];
  $description = $_POST['description'];
  $attendees = $_POST['attendess'];
  $sql = "UPDATE trips SET location = '$location',
                          dates = '$dates',
                       description = '$description',
                       attendees = '$attendees'
                       WHERE tripid = $tripid;";
  //echo $sql; echo "<br>";
  try {
    // use exec() because no results are returned
    $conn->exec($sql);
    //$tripid = $conn->lastInsertId();
    echo "Success";
    }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

}


 };

?>
