<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
</head>
<body>
  <form method='post'>
    Email: <input type='email' name='email'><br><br>
    New password: <input type='password' name='password'><br><br>
    <input type='submit' name='submit' value='Submit'><br><br>
  </form>
  <?php

    include 'Forgot.php';
    include 'Encryption.php';

    use ForgotPassword\Forgot as Forgot;
    use EncryptData\Encryption as Encryption;

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
      if(isset($_POST['submit'])){
        // New Forgot object
        $user = new Forgot($conn);
        // New Encryption objedt
        $encrypt = new Encryption();
        // Get encrypted password
        $encryptedPassword = $encrypt->encode($_POST);
        // Change the password
        $user->changePassword($_POST, $encryptedPassword);
      }
    }
    //close connection
    $conn->close();
  ?>
  <!-- Login again -->
  <a href='Login.php'>Login Again</a>
</body>
</html>
