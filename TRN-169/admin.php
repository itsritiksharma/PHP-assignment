<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body style="text-align:center">
  <h1>Admin Panel</h1>
  <?php

  include 'adminPanel.php';

  use Administrator\AdminPanel as AdminPanel;

    // Set variables to access database
  $servername = "localhost";
  $username = "root";
  $password = "Rs26!2!998";
  $dbname = "Users_data";
    //create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
    //If there's an error die
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else {
      // Create new AdminPanel object
    $admin = new AdminPanel($conn);
      // Call Users method to fetch all users
    $users = $admin->Users();
      // Verify users
    if($_GET['action'] === 'verify') {
      $id = $_GET['id'];
      $users = $admin->verify($id);
    }
  }
    //close connection
  $conn->close();
  ?>
  <table class='table'>
    <!-- print headings for table -->
    <?php foreach($users as $heading): ?>
      <?php $head = array_keys($heading); ?>
    <?php endforeach; ?>
    <tr>
      <?php foreach($head as $title): ?>
        <th scope="col">
          <?php echo $title;?>
        </th>
      <?php endforeach; ?>
      <th scope="col">Verify user</th>
    </tr>
    <!-- print users list -->
    <?php foreach($users as $user): ?>
      <tr>
        <th scope="row">
          <?php echo $user['user_id']; ?>
        </td>
        <td>
          <?php echo $user['username']; ?>
        </td>
        <td>
          <?php echo $user['email']; ?>
        </td>
        <td>
          <!-- send user in the header to verify user -->
          <form action="admin.php?id=<?=$user['user_id'] ?>&action=verify" method="post" id="formEdit<?=$user['user_id'] ?>">
            <button type="submit" class="btn btn-primary" name='complete'>Verify</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <!-- logout -->
  <a href='Login.php' style="text-decoration:none;color:white"><button type="button" class="btn btn-secondary">Logout</button></a>
</body>
</html>
