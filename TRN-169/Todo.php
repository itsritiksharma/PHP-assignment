<?php

  /**
  *
  * @file
  *
  * Store the todo tasks in database, view the todo list and remove the task from
  * database if completed.
  *
  */

  namespace TodoList;

  class Todo{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Store the todo in database.
    *
    * @param array of strings $data, [data/todo tasks from the form]
    *
    * @return $list [List of the tasks]
    *
    */
    public function storeToDo($data){
      // Query to insert data in the database
      $query = $this->conn->prepare("INSERT INTO Todo(list) VALUES(?);");
      $query->bind_param("s", $data['todo']);
      $query->execute();
      // View tasks
      $list = $this->viewToDoList();
      // Return tasks
      return $list;
    }

    /**
    *
    * View all the tasks in the database.
    *
    * @param Null
    *
    * @return $list [All tasks]
    *
    */
    public function viewToDoList(){
      // Query to select tasks from the database
      $query = "SELECT sr_no,list FROM Todo;";
      $list = $this->conn->query($query);
      $list = $list-> fetch_all(MYSQLI_ASSOC);
      // Return the list of tasks
      return $list;
    }

    /**
    *
    * If the task is complete delete it from the database.
    *
    * @param int $id [id of the task in database]
    *
    * @return $tasks [Remaining tasks after deletion]
    *
    */
    public function complete($id){
      // Query to delete the todo task with sr_no same as id.
      $query = "DELETE FROM Todo WHERE sr_no =" . $id . ";";
      $complete = $this->conn->query($query);
      // View tasks in todo list.
      $tasks = $this->viewToDoList();
      // Return remaining tasks
      return $tasks;
    }

    /**
    *
    * Destroy the started session, delete all cookies and redirect to initial page.
    *
    * @param NULL
    *
    */
    public function logout(){
      // Destroy session
      session_start();
      session_destroy();
      if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])) {
        $email = $_COOKIE['email'];
        $pass = $_COOKIE['pass'];
        // Set cookies
        setcookie('email', $email, time() -1);
        setcookie('password', $email, time() -1);
      }
      // Redirect to initial index.php page
      header("Location: index.php");
    }
  }
?>
