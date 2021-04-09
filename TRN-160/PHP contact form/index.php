<!DOCTYPE html>
<html>
<head>
  <title>PHP contact form</title>
</head>
<body>
  <form method='post'>
    Name: <input type='text' name='Name'><br>
    Email: <input type='email' name='Email'><br>
    Message: <textarea name='message'></textarea><br><br>
    <input type='submit' name='submit' value='Submit'>
  </form>
  <?php

    include 'User.php';

    use UserForm\User as User;

    //Set variables to connect to database
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
      echo "<br>";
      $newUser = new User($conn);
      //send data in database and send mail
      if(isset($_POST['submit'])){
        $newUser->sendData($_POST);
        $newUser->sendMail($_POST);
      }
    }
    //close connection
    $conn->close();
  ?>
</body>
</html>
