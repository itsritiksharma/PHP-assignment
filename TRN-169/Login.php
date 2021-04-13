<!-- Set cookies -->
<?php
  if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])) {
    $email = $_COOKIE['email'];
    $pass = $_COOKIE['password'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form method='post'>
    Username: <input type='text' name='username'><br><br>
    Email: <input type='email' name='email'><br><br>
    Password: <input type='password' name='password'><br><br>
    <input type="checkbox" name="remember" value='1'>Remember me<br><br>
    <a href='ForgotPassword.php'>Forgot Password?</a><br><br>
    <input type="submit" name='submit' value="Login">
  </form>
  <?php

    include 'Validate.php';

    use LoginForm\User as User;

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
        // New user object
        $user = new User($conn);
        // Check if the user exists
        $credentials = $user->checkIfUserExists($_POST);
        // Check if the user is admin, verified or not verified
        $user->checkUser($_POST,$credentials);
      }
    }
    //close connection
    $conn->close();
  ?>
</body>
</html>
