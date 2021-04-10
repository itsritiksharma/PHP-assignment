<?php

  /**
  *
  * @file
  *
  * Send code snippets into a database and retrieve the data.
  *
  */

  namespace CodeSnippets;

  class Snippet{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Save incoming data in the database.
    *
    * @param array of string $data [data from the form]
    *
    * @return NULL
    *
    */
    public function sendDataToDatabase($data){
      //Query to send data into the database
      $query = $this->conn->prepare("INSERT INTO code_snippets (code_snippet, code_description, language)
      VALUES (?,?,?);");
      $query->bind_param("sss",$data['snippet'],$data['description'],$data['language']);
      //Execute query
      $query->execute();
      return;
    }

    /**
    *
    * Retrieve data from the database.
    *
    * @param Null
    *
    * @return array of strings $data [array with submitted data retrieved form database]
    *
    */
    public function retrieveData(){
      // Query to Select the data from the database.
      $query = "SELECT code_snippet, code_description, language FROM code_snippets;";
      // Execute the query on the connection.
      $data = $this->conn->query($query);
      // Fetch data in form of array
      $data = $data-> fetch_all(MYSQLI_ASSOC);
      return $data;
    }
  }
?>
