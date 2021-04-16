<?php

  /**
  *
  * @file
  *
  * Send user data to the database and direct the user to login form.
  *
  */

  namespace SignUpForm;

  class SignUp{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Send user data in database and redirect user to Login page.
    *
    * @param array of strings $data, string $encpass [$data stores the form data and
    * $encpass stores the encrypted password of user]
    *
    */
    public function sendUserInfo($data, $encpass){
      $question = explode("_",$data['question']);
      $securityQuestion = $question[1];
      // Query to insert data in the database
      $query = $this->conn->prepare("INSERT INTO Users(username, email, password, security_question, security_answer) VALUES(?,?,?,?,?);");
      $query->bind_param("sssss", $data['username'], $data['email'], $encpass, $securityQuestion, $data['answer']);
      $query->execute();
      // Redirect user to login page
      header("Location: SignUpSuccessful.php");
    }
  }
  ?>
