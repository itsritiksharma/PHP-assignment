<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>To do list</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
  <div style="text-align:center; margin: 10px">
    <form method='post'>
      Add to do: <input type='text' name='todo'>
      <button type='submit' name='submit' class="btn btn-info">Add</button>

      <button type='submit' name='logout' class="btn btn-secondary">Logout</button>
    </form>
  </div>
  <?php

  include 'Todo.php';

  use TodoList\Todo as Todo;

    // Set variables to access database
  $servername = "localhost";
  $username = "root";
  $password = "Rs26!2!998";
  $dbname = "Todo_list";
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
  <ul class="list-group">
    <?php foreach($list as $tasks): ?>
      <li class="list-group-item">
        <span>
          <!-- Send the sr.no. of the todo in header -->
          <form action="ToDoList.php?id=<?=$tasks['sr_no'] ?>&action=delete" method="post" id="formEdit<?=$tasks['sr_no'] ?>">
            <?php echo $tasks['list']; ?>
            <button type="submit" name='complete' class="btn btn-success">Complete</button>
          </form>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
