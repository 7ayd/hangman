<?php

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";

$sql = "INSERT INTO trips(location,dates,links,description,attendees,cost)
    VALUES ('China', '12/29/2018', 'url.gif', 'Everyone come through', 'Bisher', 900);";
echo $sql;
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // use exec() because no results are returned
  $conn->exec($sql);
  }

catch(PDOException $e)
  {
  echo $sql . "<br>" . $e->getMessage();
  }

?>
