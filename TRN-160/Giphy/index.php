<!DOCTYPE html>
<html>
<head>
  <title>Rando Gif</title>
</head>
<body>
  <?php
    include 'Giphy.php';

    use GiphyApi\Giphy as Giphy;

    // Set variables to access database
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "database";
    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //If there's an error die
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else {
      echo 'connected successfully';
      $gif = new Giphy($conn);
      //send data in database and retrieve it and store into $grid variable
      $newGif = $gif->getRandomGif();
    }
    //close connection
    $conn->close();
  ?>
  <!-- Display random gif -->
  <img src=<?php echo "" . $newGif . "";?>>
</body>
</html>
