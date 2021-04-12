<!DOCTYPE html>
<html>
<head>
  <title>Store input data</title>
</head>
<body>
  <form method='post'>
    Employee Code: <input type='text' name='employeeCode'><br>
    Employee Code Name: <input type='text' name='employeeCodeName'><br>
    Employee Domain: <input type='text' name='employeeDomain'><br>
    Employee Salary: <input type='text' name='employeeSalary'><br>
    Employee First Name: <input type='text' name='employeeFirstName'><br>
    Employee Last Name: <input type='text' name='employeeLastName'><br>
    Graduation Percentile: <input type='text' name='graduationPercentile'><br>
    Employee ID: <input type='text' name='employeeID'><br>
    <input type='submit' name='submit' value='Submit'><br>
    <input type='submit' name='show_table' value='Show Table'><br>
  </form>
  <?php

    include_once 'Database.php';

    use FormData\Database as Database;

      $servername = "localhost";
      $username = "root";
      $password = "Password";
      $dbname = "database";
      //create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      //If there's an error die
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      else {
        echo 'connected successfully';
        $newRecord = new Database($conn);
        //send data in database
        if(isset($_POST['submit'])){
          $newRecord->sendData($_POST);
        }
        //retrieve data from database
        if(isset($_POST['show_table'])){
          $newRecord->retrieveData();
        }
      }
    //close connection
    $conn->close();
  ?>
</body>
</html>

