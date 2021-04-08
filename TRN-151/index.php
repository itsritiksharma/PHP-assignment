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
    include 'Database.php';
    use FormData\Database as Database;
      //Three arrays which store the data for three tables.
      $employee_details = [];
      $employee_code_array = [];
      $employee_salary_array = [];
      //form data stored in variables
      $employee_code = $_POST['employeeCode'];
      $employee_code_name = $_POST['employeeCodeName'];
      $employee_domain = $_POST['employeeDomain'];
      $employee_salary = $_POST['employeeSalary'];
      $employee_fname = $_POST['employeeFirstName'];
      $employee_lname = $_POST['employeeLastName'];
      $employee_grad_percentile = $_POST['graduationPercentile'];
      $employee_id = $_POST['employeeID'];
      //form data pushed into arrays
      array_push($employee_code_array, $employee_code, $employee_code_name, $employee_domain);
      array_push($employee_salary_array, $employee_id, $employee_salary, $employee_code);
      array_push($employee_details,$employee_id,$employee_fname,$employee_lname,$employee_grad_percentile);
      $servername = "localhost";
      $username = "root";
      $password = "password";
      $dbname = "databaseName";
      //create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      //If there's an error die
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      else{
        echo 'connected successfully';
        $newRecord = new Database($conn);
        //send data in database
        if(isset($_POST['submit'])){
          $newRecord->sendData($employee_code_array,$employee_salary_array,$employee_details);
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

