<?php

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";



function adjustPeople($people){
  $pieces = explode(",", $people);
  $lastElement = end($pieces);
  $person_string = '';
  foreach ($pieces as &$person) {
      if($person==$lastElement){
        $person_string .= sprintf('"%s"',$person);
      }
      else{
      $person_string .= sprintf('"%s",',$person);}
  }

  return $person_string;

}

function adjustLinks($links){

  $link_array = explode(",", $links);
  $lastElement = end($link_array);
  $array_string = '';
  foreach ($link_array as &$link) {
      if($link==$lastElement){
        $array_string .= sprintf('"%s"',$link);
      }
      else{
      $array_string .= sprintf('"%s",',$link);}
  }

  return $array_string;
}


function handle_multiple_files($image_folder){
  $total = count($_FILES['file']['name']);
  echo $total; echo "<br>";
  $image_folder = $image_folder."uploadFiles/";
  mkdir($image_folder,0777);
// Loop through each file
  for( $i=0 ; $i < $total ; $i++ ) {
    echo "In for loop"; echo "<br>";

  //Get the temp file path
  $tmpFilePath = $_FILES['file']['tmp_name'][$i];
  echo $tmpFilePath;echo "<br>";

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $image_path = $image_folder . $_FILES['file']['name'][$i];

    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $image_path);

      //Handle other code here


  }
}
}

function handle_multiple_urls($image_url,$image_folder){
  $urls = explode(" ", $image_url);
  $total = count($urls);
  $image_folder = $image_folder."urlFiles/";
  mkdir($image_folder,0777);

  for( $i=0 ; $i < $total ; $i++ ) {
    echo strlen($urls[(int)$i]);
    //echo "CHECKING TYPES: "; echo gettype(i); echo gettype(0); echo gettype((int)$i); echo "<br>";
    $image_path = $image_folder.$i.".jpg";
    echo $image_path; echo "<br>";
    file_put_contents($image_path,file_get_contents($urls[(int)$i]));
}}


////Script Portion/////

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
  //"SELECT * FROM trips WHERE tripid in (SELECT tripid FROM grouptrips WHERE groupid = 0);";
  $sql = "SELECT * FROM trips WHERE tripid in (SELECT tripid FROM publictrips WHERE public = 1);";
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
    $tripid = $row['tripid'];
    $image_folder = '../trip-images/'.$tripid.'/';
    $file = glob($image_folder . '*');
    $countFile = 0;
    if ($file != false)
    {
      $countFile = count($file);
    }

    echo $location; echo('!'); echo $dates; echo('!'); echo $links; echo('!');
    echo $description; echo('!'); echo $attendees; echo('!'); echo $cost; echo('!'); echo $tripid;
    echo('!'); echo $countFile;
    echo "\n";
  }
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $location = $_POST['location'];
  $location = str_replace(' ','-', $location);
  echo $location;
  // $date = $_POST['dates'];
  // //$image_url = $_POST['pictures'];
  // //$image_upload = $_FILES['file']['tmp_name'];
  // $more_links = $_POST['links'];
  // $summary = $_POST['description'];
  // $going = str_replace(" ",",",$_POST['attendess']);
  // $total = $_POST['cost'];
  $groupid = $_POST['groupid'];
  echo "HELLO";
  echo $groupid;
  echo "<br>";
  //
  // //$more_links = adjustLinks($more_links);
  //
  // $more_links = explode(" ",$more_links);
  // $more_links = implode(",",$more_links);


/*
  var_dump($_POST); echo "<br>";

  echo "Number of files passed in "; echo "<br>";
  echo count($_FILES['file']['name']); echo "<br>";
  var_dump($_FILES['file']); echo "<br>";
  echo count($_FILES); echo "<br>";

  echo "Done checking files"; echo "<br>";

  echo $location; echo "<br>";
  echo $date; echo "<br>";
  echo $image_url; echo "<br>";
  echo $image_upload; echo "<br>";
  echo $more_links; echo "<br>";
  echo $summary; echo "<br>";
  echo $going; echo "<br>";
  echo $total; echo "<br>";


*/


// $image_folder = '../saved_images/'.$location.'/';
/*echo "Image Folder Created"; echo "<br>";
echo $image_folder; echo "<br>"; */
//mkdir($image_folder,0777);


  // try {
  //   handle_multiple_urls($image_url,$image_folder);
  // }
  // catch (exception $e){}
  //
  //
  // try {
  //   handle_multiple_files($image_folder);
  // }
  //
  // catch (exception $e){};




    // $sql = "INSERT INTO trips(location,dates,links,description,attendees,cost,groupid)
    //     VALUES ('$location', '$date', '$more_links', '$summary', '$going', $total,$groupid);";
    // echo $sql;
    // try {
    //   // use exec() because no results are returned
    //   $conn->exec($sql);
    //   }
    //
    // catch(PDOException $e)
    //   {
    //   echo $sql . "<br>" . $e->getMessage();
    //   }


        $sql = "INSERT INTO trips(location)
            VALUES ('$location');";
        echo $sql;
        try {
          // use exec() because no results are returned
          $conn->exec($sql);
          $tripid = $conn->lastInsertId();
          }

        catch(PDOException $e)
          {
          echo $sql . "<br>" . $e->getMessage();
          }

       $nextsql = "INSERT INTO grouptrips(tripid,groupid)
                  VALUES ($tripid,$groupid);";
        try{
          $conn->exec($nextsql);
        }

        catch(PDOException $e)
        {
          echo $sql . "<br>>" . $e->getMessage();
        }





};
/*





  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO trips (dates,place,going,summary,total,images)
          VALUES ('$date','$location','$person_string','$summary',$total,'$image_path');";
    // use exec() because no results are returned
    $conn->exec($sql);
    }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  echo $sql;

};


$conn = null;
*/
?>
