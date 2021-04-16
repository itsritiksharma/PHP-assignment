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
      $question = explode("_",$data['question']);
      $securityQuestion = $question[1];
      // print_r($data);
      $query = "SELECT * FROM Users WHERE email ='" . $data['email'] . "' and username = '" . $data['username'] . "' and security_answer ='" . $data['answer'] . "';";
      $userData = $this->conn->query($query);

      if($userData->num_rows >0){
        if($data['confpassword'] <> $data['password']){
          return "Password mismatch!";
        }
        else{
          $query2 = "UPDATE Users SET password = '" . $newencpassword . "' WHERE email = '" . $data['email'] . "' AND username = '" . $data['username'] . "' AND security_question = '" . $securityQuestion . "' AND security_answer = '" . $data['answer'] . "';";
          $user = $this->conn->query($query2);
          return "Password updated Successfully!<br><br>";
        }
      }
      else{
        return "No User found! Enter valid details.";
      }
    }
  }
  ?>
