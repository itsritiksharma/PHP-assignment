<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
</head>
<body>
  <h1>Admin Panel</h1>
  <?php

    include 'adminPanel.php';

    use Administrator\AdminPanel as AdminPanel;

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
      // Create new AdminPanel object
      $admin = new AdminPanel($conn);
      // Call Users method to fetch all users
      $users = $admin->Users();
      // Verify users
      if($_GET['action'] === 'verify') {
        $id = $_GET['id'];
        $admin->verify($id);
      }
    }
    //close connection
    $conn->close();
  ?>
  <table border=1px>
    <!-- print headings for table -->
    <?php foreach($users as $heading): ?>
      <?php $head = array_keys($heading); ?>
    <?php endforeach; ?>
    <tr>
    <?php foreach($head as $title): ?>
      <th>
        <?php echo $title;?>
      </th>
    <?php endforeach; ?>
    </tr>
    <!-- print users list -->
    <?php foreach($users as $user): ?>
      <tr>
        <td>
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
          <input type="submit" name='complete' value="verify">
        </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <!-- logout -->
<a href='Login.php'>Logout</a>
</body>
</html>
