<?php

$servername = "127.0.0.1";
$username = "root";
$password = "jibneh82";
$dbname = "hangman";


$coming_from =  $_SERVER['REQUEST_URI'];
$uri_array = explode ("/", $coming_from);
$url_portion = $uri_array[3];

function handle_multiple_files($image_folder,$countFile){
  echo "ATtempting to handle files";
  $total = count($_FILES['file']['name']);
  echo $total; echo "<br>";

//  mkdir($image_folder,0777);
// Loop through each file

  for( $i=0 ; $i < $total ; $i++ ) {
    echo "In for loop"; echo "<br>";

  //Get the temp file path
  $tmpFilePath = $_FILES['file']['tmp_name'][$i];
  echo $tmpFilePath;echo "<br>";

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path

    $image_path = $image_folder.'trip-image'.$countFile.'.png';

    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $image_path);

      //Handle other code here


  }
}
}


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if($url_portion == 'profile-pic'){
  $img_file =  $_FILES['passin_file_image']['tmp_name'];
  $img_url =  $_POST['passin_url_image'];
  $userid = $_POST['userid'];

  echo $img_file; echo "<br>"; echo $img_url; echo "<br>"; echo $userid; echo "<br>";

  $url_size = strlen($img_url); $file_size = strlen($img_file);
  $image_path = '../saved_profile_pictures/'.$userid.'-profile_pic.png';

   // mkdir($image_folder,0777);

   try{
    echo 'In try statement'; echo '<br>';
    if($url_size > 9){
      echo 'In URL statement'; echo '<br>';
      if(!$img_url){throw Exception;};
      file_put_contents($image_path, file_get_contents($img_url));
      //$image_path = $image_folder.'profile_pic.png';

    }
    if($file_size>10){
      echo 'In File statement'; echo '<br>';
      if(!$img_file){throw Exception;};
      file_put_contents($image_path, file_get_contents($img_file));
      //$image_path = $image_folder.'profile_pic.png';
    }


  }
  catch(Exception $e){
    echo 'GOT CAUGHT';
    echo $e;
    $image_path = 'noimage';
  }

// if($img_loc == 'undefined'  && $file_size == 0){
//   $image_path = 'noimage';
//   echo 'No image uploaded'; echo '<br>';
// }

    $sql = "INSERT INTO profilepictures(userid,picturepath) VALUES($userid,'$image_path');";
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

///////////////////////////////////////

  if($url_portion == 'trip-image'){
      echo "We are in the right spot";

      //$img_file =  $_FILES['passin_file_image']['tmp_name'];
      echo "PRINTRING"; print_r($_FILES);
      echo "VARDUMPING"; var_dump($_FILES);

      $img_url =  $_POST['passin_url_image'];
      $tripid = $_POST['tripid'];

      echo $img_file; echo "<br>"; echo $img_url; echo "<br>"; echo $tripid; echo "<br>";

      $url_size = strlen($img_url); $file_size = strlen($img_file);

      $image_folder = '../trip-images/'.$tripid.'/';

      if (!file_exists($image_folder)) {
        mkdir($image_folder,0777);
      }


      $file = glob($image_folder . '*');
      $countFile = 0;
      if ($file != false)
      {
        $countFile = count($file);
      }
      // print_r($countFile);

       try{
        echo 'In try statement'; echo '<br>';
        if($url_size > 9){
          $image_path = $image_folder.'trip-image'.$countFile.'.png';
          echo 'In URL statement'; echo '<br>';
          if(!$img_url){throw Exception;};
          file_put_contents($image_path, file_get_contents($img_url));
          //$image_path = $image_folder.'profile_pic.png';

        }
        if($_FILES){

          try {
            handle_multiple_files($image_folder,$countFile);
          }

          catch (exception $e){};
        }


      }
      catch(Exception $e){
        echo 'GOT CAUGHT';
        echo $e;
        $image_path = 'noimage';
      }

        // $sql = "INSERT INTO tripictures(tripid,picturepath) VALUES($tripid,'$image_path');";
        // try {
        //   // use exec() because no results are returned
        //   $conn->exec($sql);
        //   //$tripid = $conn->lastInsertId();
        //   echo "Success";
        //   }
        //
        // catch(PDOException $e)
        //   {
        //   echo $sql . "<br>" . $e->getMessage();
        //   }
    }
}
?>
