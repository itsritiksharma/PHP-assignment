<?php

  /**
  *
  * @file
  *
  * Change the password in the database.
  *
  */

  namespace ForgotPassword;

  class Forgot{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Changes the password in the database.
    *
    * @param array of strings $data, string $newencpassword [$data contains data
    * from form submission and $newencpassword contains the new encrypted password]
    *
    */
    public function changePassword($data, $newencpassword){
      // Query to update password column for the Users
      $query = "UPDATE Users SET password = '" . $newencpassword . "' WHERE email = '" . $data['email'] . "';";
      $user = $this->conn->query($query);
      echo "Password updated Successfully!<br><br>";
    }
  }
?>
