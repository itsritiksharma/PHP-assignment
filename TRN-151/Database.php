<?php
  namespace FormData;
  class Database{
    //set connection variable
    public $conn;
    function __construct($conn){
      $this->conn = $conn;
    }
    //function to send the data into database
    function sendData(){
      //$table#data is an array which has data about the of table
      //Query to insert in employee_code_table using prepare statement.
      $query1 = $this->conn->prepare("INSERT INTO employee_code_table (employee_code, employee_code_name, employee_domain)
      VALUES (?, ?, ?);");
      $query1->bind_param("sss",$employee_code,$employee_code_name,$employee_domain);
      echo "hello1";
      //Query to insert in employee_salary_table
      $query2 = $this->conn->prepare("INSERT INTO employee_salary_table (employee_id, employee_salary, employee_code)
      VALUES (?, ?, ?);");
      $query2->bind_param("sis",$employee_id,$employee_salary,$employee_code);
      echo "hello2";
      //Query to insert in employee_details_table
      $query3 = $this->conn->prepare("INSERT INTO employee_details_table (employee_id, employee_first_name, employee_last_name, graduation_percentile)
      VALUES (?, ?, ?, ?);");
      $query3->bind_param("sssi",$employee_id,$employee_first_name,$employee_last_name,$graduation_percentile);
      //Set data for employee_code_table and execute query1.
      $employee_code = $_POST['employeeCode'];
      $employee_code_name = $_POST['employeeCodeName'];
      $employee_domain = $_POST['employeeDomain'];
      $query1->execute();
      //Set data for employee_salary_table and execute query2.
      $employee_id = $_POST['employeeID'];
      $employee_salary = $_POST['employeeSalary'];
      $query2->execute();
      //Set data for employee_details_table and execute query3.
      $employee_first_name = $_POST['employeeFirstName'];
      $employee_last_name = $_POST['employeeLastName'];
      $graduation_percentile = $_POST['graduationPercentile'];
      $query3->execute();
      //append all queries into one and run multiple queries with multi_query
      $query = $query1.$query2.$query3;
      if ($this->conn->multi_query($query) === TRUE) {
        echo "New records created successfully";
      } else {
        echo "Error: " . $query . "<br>" . $this->conn->error;
      }
      return;
    }
    //function to make queries to retrieve data
    function retrieveData(){
      $all_queries = [];
      //Query to list all employee first name with salary greater than 50k.
      $query1 = "SELECT employee_details_table.employee_first_name, employee_salary_table.employee_salary FROM employee_details_table inner join employee_salary_table on employee_details_table.employee_id = employee_salary_table.employee_id where employee_salary_table.employee_salary > 50000;";
      //Query to list all employee last name with graduation percentile greater than 70%.
      $query2 = "SELECT employee_details_table.employee_last_name, employee_details_table.graduation_percentile FROM employee_details_table where employee_details_table.graduation_percentile > 70;";
      //Query to list all employee code name with graduation percentile less than 70%.
      $query3 = "SELECT employee_code_table.employee_code_name from employee_code_table left join (employee_salary_table left join employee_details_table on employee_details_table.employee_id = employee_salary_table.employee_id) on employee_salary_table.employee_code = employee_code_table.employee_code where employee_details_table.graduation_percentile < 70;";
      //Query to list all employee’s full name that are not of domain Java.
      $query4 = "SELECT employee_details_table.employee_first_name, employee_details_table.employee_last_name from employee_details_table left join (employee_salary_table left join employee_code_table on employee_code_table.employee_code = employee_salary_table.employee_code) on employee_details_table.employee_id = employee_salary_table.employee_id where employee_code_table.employee_domain <> 'Java';";
      //Query to list all employee_domain with sum of it's salary.
      $query5 = "SELECT sum(employee_salary_table.employee_salary) as salary_sum,employee_code_table.employee_domain from employee_code_table inner join employee_salary_table on employee_salary_table.employee_code = employee_code_table.employee_code group by employee_domain;";
      //Query to not include salaries which is less than 30k.
      $query6 = "SELECT sum(B.employee_salary) as salary_sum,A.employee_domain from employee_code_table as A inner join employee_salary_table as B on B.employee_code = A.employee_code where B.employee_salary >= 30000 group by employee_domain;";
      //Query to list all employee id which has not been assigned employee code.
      $query7 = "SELECT A.employee_id from employee_salary_table as A where A.employee_code is NULL;";
      $all_queries = array($query1, $query2,$query3,$query4,$query5,$query6,$query7);
      //call to a function which displays data in form of table for each query
      foreach ($all_queries as $query) {
        $table = $this->conn->query($query);
        $table = $table-> fetch_all(MYSQLI_ASSOC);
        $this->showTable($table);
      }
    }
    //function to display data in table format
    function showTable($tabledata){
      //flag to set table headings from first element of table
      $flag_column=0;
      //create a table
      echo "<table border=1px>";
      for($index=0;$index<count($tabledata);$index++){
        if($flag_column==0){
          //table row for headings
          echo "<tr>";
          foreach($tabledata[$index] as $key=>$value){
            echo "<th>".$key."</th>";
          }
          echo "</tr>";
          //table row for values
          echo "<tr>";
          foreach($tabledata[$index] as $key=>$value){
            echo "<td>".$value."</td>";
          }
          echo "</tr>";
          $flag_column=1;
        }
        //All headings are set now put all the values in the table
        else{
          echo "<tr>";
          foreach($tabledata[$index] as $key=>$value){
            echo "<td>".$value."</td>";
          }
          echo "</tr>";
        }
      }
      echo "</table>";
      echo "<br>";
    }
  }
?>
