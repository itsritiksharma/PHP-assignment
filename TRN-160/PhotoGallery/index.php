<!DOCTYPE html>
<html>
<head>
  <title>Photo Gallery</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    Upload file: <input type="file" name="file"><br><br>
    Description: <textarea name='description'></textarea><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>
  <?php

    include 'Gallery.php';

    use CreateGallery\Gallery as Gallery;

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
      $myGallery = new Gallery($conn);
      //send data in database and retrieve it and store into $grid variable
      if(isset($_POST['submit'])){
        $fileName = $myGallery->uploadFiles($_FILES);
        $myGallery->sendDataToDatabase($_POST,$fileName);
        $grid = $myGallery->retrieveData();
      }
    }
    //close connection
    $conn->close();
  ?>
  <!-- Show data in a Grid -->
  <div class='grid-container'>
    <?php foreach($grid as $gridItem): ?>
      <!-- Create grid items -->
      <div class='grid-item'>
        <div class='image'>
          <img src=<?php echo "./uploads/" . $gridItem['image_path'] . ""; ?>>
        </div>
        <div class='description'>
          <span><?php echo $gridItem['image_description']; ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
