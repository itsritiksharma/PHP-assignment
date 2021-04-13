<!DOCTYPE html>
<html>
<head>
  <title>Form</title>
</head>
<body>
  <h1>New User? Sign UP:</h1>
    <form method='post'>
      Username: <input type='text' name="username"><br><br>
      Email: <input type='email' name='email'><br><br>
      Password: <input type='password' name='password'><br><br>
      <input type='submit' name='submit' value='Submit'>
    </form>
  <h1>Existing user? <a href='Login.php'>Login</a></h1>
  <?php

    include 'SignUp.php';
    include 'Encryption.php';

    use SignUpForm\SignUp as SignUp;
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
        // Create new user
        $user = new SignUp($conn);
        // New password encryption for user
        $encrypt = new Encryption();
        // Call the encode method to encode password
        $encryptedPassword = $encrypt->encode($_POST);
        // Sotre the user data in a database
        $user->sendUserInfo($_POST, $encryptedPassword);
      }
    }
    //close connection
    $conn->close();
  ?>
</body>
</html>
