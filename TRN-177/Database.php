<?php

  /**
  *
  * @file
  *
  * Send incoming data to a database.
  *
  */

  // Request email, password and username.
  $mail = $_REQUEST['email'];
  $uname = $_REQUEST['username'];
  $pass = $_REQUEST['password'];

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
    //Query to insert data into the database.
    $query = $conn->prepare("INSERT INTO Users(username, email, password) VALUES(?,?,?);");
    $query->bind_param("sss", $uname, $mail, $pass);
    $query->execute();
    // Finally echo.
    echo "Details saved successfully!!";
  }
  //close connection
  $conn->close();
  ?>
