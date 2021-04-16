<?php

  /**
  *
  * @file
  *
  * Fetch users from database, verify users and finally logout.
  *
  */

  namespace Administrator;

  class AdminPanel{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Fetch all unverified Users which are not admin from the database.
    *
    * @param NULL
    *
    * @return $unVerified [all unverified users]
    *
    */
    public function Users(){
      // Query to select the users which are not verified and are not admin
      $query = "SELECT user_id, username, email FROM Users WHERE admin = 0 AND verify = 0;";
      $unVerified = $this->conn->query($query);
      $unVerified = $unVerified->fetch_all(MYSQLI_ASSOC);
      // Return unverifed users
      return $unVerified;
    }

    /**
    *
    * Verify the users with the userid coming from the header and call the Users
    * method again to return the unverified users.
    *
    * @param int $userid [user's id]
    *
    */
    public function verify($userid){
      // Query to verigy the user
      $query = "UPDATE Users SET verify = 1 WHERE user_id=" . $userid . ";";
      $verified = $this->conn->query($query);
      // Calls Users method
      $users = $this->Users();
      return $users;
    }
  }
  ?>
