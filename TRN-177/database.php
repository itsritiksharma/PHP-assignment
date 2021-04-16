<?php

  class data{
    public $conn;
    public $servername = "localhost";
    public $username = "root";
    public $password = "password";
    public $dbname = "dbname";
    public $userTbl = "tbname";
    public function __construct(){
      $this->conn = new mysqli($this->servername, $this->username,  $this->password, $this->dbname);
    }

    public function checkUser($userData){
      if(!empty($userData)){
        // Check whether user data already exists in database
        $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE username = '".$userData['user_first_name']."' AND email= '".$userData['user_email_address']."'";
        $prevResult = $this->conn->query($prevQuery);
        if($prevResult->num_rows > 0){
          // Update user data if already exists
          $query = "UPDATE ".$this->userTbl." SET username = '".$userData['user_first_name']."', email = '".$userData['user_email_address']."'";
          $update = $this->conn->query($query);
          echo "<h2>Welcome Back ".$userData['user_first_name']."!!</h2>";
        }else{
          // Insert user data
          $query = $this->conn->prepare("INSERT INTO ".$this->userTbl."(username, email) VALUES (?,?);");
          $query->bind_param("ss", $userData['user_first_name'], $userData['user_email_address']);
          $query->execute();
        }

        // Get the user data from the database
        $result = $this->conn->query($prevQuery);
        $userData = $result->fetch_assoc();
      }

      // Return the user data
      return $userData;
    }

    public function checkUserGit($userData){
      if(!empty($userData)){
        // Check whether user data already exists in database
        $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE username = '".$userData['login']."' AND email= '".$userData['html_url']."'";
        $prevResult = $this->conn->query($prevQuery);
        if($prevResult->num_rows > 0){
          // Update user data if already exists
          $query = "UPDATE ".$this->userTbl." SET username = '".$userData['login']."', email = '".$userData['html_url']."' WHERE user_id = (SELECT user_id FROM ".$this->userTbl." WHERE username = '".$userData['login']."' AND email= '".$userData['html_url'].")'";
          $update = $this->conn->query($query);
          echo "<h2>Welcome Back ".$userData['login']."!!</h2>";
        }else{
          // Insert user data
          $query = $this->conn->prepare("INSERT INTO ".$this->userTbl."(username, email) VALUES (?,?);");
          $query->bind_param("ss", $userData['login'], $userData['html_url']);
          $query->execute();
        }

        // Get the user data from the database
        $result = $this->conn->query($prevQuery);
        $userData = $result->fetch_assoc();
      }

      // Return the user data
      return $userData;
    }
  }
?>
