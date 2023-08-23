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




//  echo "WE OUT HERE";

  $sql = "SELECT groupid,name,description FROM groups;";
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

  foreach($stmt->fetchAll() as $row){
    $group = $row['groupid'];
    $name = $row['name'];
    $purpose = $row['description'];
    echo $group; echo('!');echo $name; echo('!'); echo $purpose; echo "\n";
  }



?>
