<?php

  /**
  *
  * @file
  *
  * Validate the login credentials of a user if the user is admin or unverified user.
  *
  */

  namespace LoginForm;

  include 'Encryption.php';

  use EncryptData\Encryption as Encryption;

  class User{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Checks if the user exists in the database.
    *
    * @param array of strings $form [data from form submission]
    *
    * @return $user[0] [if user exists return the user]
    *
    */
    public function checkIfUserExists($form){
      // Query to Select the user with same email and username
      $query = "SELECT email, username, password , admin, verify FROM Users WHERE email ='" . $form['email'] . "' AND username = '" . $form['username'] . "';";
      $user = $this->conn->query($query);
      $user = $user-> fetch_all(MYSQLI_ASSOC);
      // return user
      return $user[0];
    }

    /**
    *
    * Create a session for the user for to do list.
    *
    * @param array of strings $formData, array of strings $usercred [$formData
    * contains the data from form and $usercred contains the user credentials]
    *
    */
    public function createSession($formData, $usercred){
      // Decrypt the password
      $encrypt = new Encryption();
      $mypassword = $encrypt->decode($usercred['password']);
      // Set all the checking variables
      $myemail = $usercred['email'];
      $uname = $usercred['username'];
      $email = $formData['email'];
      $password = $formData['password'];
      $username = $formData['username'];
      // Check if the email, username and password in form are same as email, username and password in database
      if($email == $myemail && $username == $uname && $password == $mypassword) {
        // Set cookies for 1 day
        if(isset($formData['remember'])) {
          setcookie('email', $email, time() + 60*60*7);
          setcookie('password', $email, time() + 60*60*7);
        }
        // Start session
        session_start();
        $_SESSION['email'] = $email;
        // Redirect to the todo list
        header("location: ToDoList.php");
      } else {
        // Echo if the email or password is invalid
        return "E-mail or password is invalid.<br> click here to <a href = 'Login.php'> try again </a>";
      }
    }

    /**
    *
    * Checks if the user is an admin or an unverified user or verified.
    *
    * @param array of strings $data, array of strings $cred [$data contains the data
    * from form and $cred contains the credential of users]
    *
    */
    public function checkUser($data,$cred){
      // Check if the user is admin
      if($cred['admin'] == 1) {
        // Redirect to admin dashboard
        header("Location: admin.php");
      }
      else {
        $query = "SELECT * FROM Users WHERE email ='" . $data['email'] . "' and username = '" . $data['username'] . "';";
        $userData = $this->conn->query($query);
        if($userData->num_rows >0){
        // Check if the user is verified
          if($cred['verify'] == 0) {
            return "Your account is not verified";
          }
          else {
          // If user is verified and not admin create the session for user
            $result =  $this->createSession($data,$cred);
            return $result;
          }
        }
        else{
          return "No user found!!";
        }
      }
    }
  }
  ?>
