<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>To do list</title>
</head>
<body>
  <form method='post'>
    Add To do: <input type='text' name='todo'>
    <input type='submit' name='submit' value='Add'>
    <input type='submit' name='logout' value='Logout'>
  </form>
  <?php

    include 'Todo.php';

    use TodoList\Todo as Todo;

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
      // New Todo object
      $todo = new Todo($conn);
      if(isset($_POST['submit'])){
        if(!empty($_POST['todo'])){
          // Store the todo in database
          $list = $todo->storeToDo($_POST);
        } else {
          echo "Add to do";
        }
      }
      if(isset($_POST['logout'])){
        // Logout
        $todo->logout();
      }
      // If the header contains action as delete set id to id in header
      if($_GET['action']==='delete'){
        // If the to do task is completed remove it
        $id = $_GET['id'];
        $list = $todo->complete($id);
      }
    }
    //close connection
    $conn->close();
  ?>
  <!-- Print the to do list -->
  <ul>
    <?php foreach($list as $tasks): ?>
      <li>
        <?php echo $tasks['list']; ?>
        <!-- Send the sr.no. of the todo in header -->
        <form action="ToDoList.php?id=<?=$tasks['sr_no'] ?>&action=delete" method="post" id="formEdit<?=$tasks['sr_no'] ?>">
          <input type="submit" name='complete' value="Complete">
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
