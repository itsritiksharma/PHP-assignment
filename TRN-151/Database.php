<?php

  namespace FormData;

  class Database{
    //set connection variable
    public $conn;
    function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Send the data into database
    *
    * @param array of string $data [array of data coming from the form]
    *
    * @return NULL
    *
    */
    public function sendData($data){
      //Query to insert in employee_code_table using prepare statement.
      $query1 = $this->conn->prepare("INSERT INTO employee_code_table (employee_code, employee_code_name, employee_domain)
      VALUES (?, ?, ?);");
      $query1->bind_param("sss",$data['employeeCode'],$data['employeeCodeName'],$data['employeeDomain']);
      //Query to insert in employee_salary_table
      $query2 = $this->conn->prepare("INSERT INTO employee_salary_table (employee_id, employee_salary, employee_code)
      VALUES (?, ?, ?);");
      $query2->bind_param("sis",$data['employeeID'],$data['employeeSalary'],$data['employeeCode']);
      //Query to insert in employee_details_table
      $query3 = $this->conn->prepare("INSERT INTO employee_details_table (employee_id, employee_first_name, employee_last_name, graduation_percentile)
      VALUES (?, ?, ?, ?);");
      $query3->bind_param("sssi",$data['employeeID'],$data['employeeFirstName'],$data['employeeLastName'],$data['graduationPercentile']);
      //execute query1.
      $query1->execute();
      //execute query2.
      $query2->execute();
      //execute query3.
      $query3->execute();
      //append all queries into one and run multiple queries with multi_query
      $query = $query1 . $query2 . $query3;
      //Tells if the records are created or there was an error
      if ($this->conn->multi_query($query) === TRUE) {
        echo "New records created successfully";
      }
      else {
        echo "Error: " . $query . "<br>" . $this->conn->error;
      }
      return;
    }

    /**
    *
    * Use Queries to retrieve data
    *
    * Calls a method to print data in table format
    *
    */
    public function retrieveData(){
      $all_queries = [];
      //Query to list all employee first name with salary greater than 50k.
      $query1 = "SELECT employee_details_table.employee_first_name, employee_salary_table.employee_salary FROM employee_details_table inner join employee_salary_table ON employee_details_table.employee_id = employee_salary_table.employee_id WHERE employee_salary_table.employee_salary > 50000;";
      //Query to list all employee last name with graduation percentile greater than 70%.
      $query2 = "SELECT employee_details_table.employee_last_name, employee_details_table.graduation_percentile FROM employee_details_table WHERE employee_details_table.graduation_percentile > 70;";
      //Query to list all employee code name with graduation percentile less than 70%.
      $query3 = "SELECT employee_code_table.employee_code_name FROM employee_code_table left join (employee_salary_table left join employee_details_table ON employee_details_table.employee_id = employee_salary_table.employee_id) ON employee_salary_table.employee_code = employee_code_table.employee_code WHERE employee_details_table.graduation_percentile < 70;";
      //Query to list all employee’s full name that are not of domain Java.
      $query4 = "SELECT employee_details_table.employee_first_name, employee_details_table.employee_last_name FROM employee_details_table left join (employee_salary_table left join employee_code_table ON employee_code_table.employee_code = employee_salary_table.employee_code) ON employee_details_table.employee_id = employee_salary_table.employee_id WHERE employee_code_table.employee_domain <> 'Java';";
      //Query to list all employee_domain with sum of it's salary.
      $query5 = "SELECT sum(employee_salary_table.employee_salary) AS salary_sum,employee_code_table.employee_domain FROM employee_code_table inner join employee_salary_table on employee_salary_table.employee_code = employee_code_table.employee_code GROUP BY employee_domain;";
      //Query to not include salaries which is less than 30k.
      $query6 = "SELECT sum(B.employee_salary) AS salary_sum,A.employee_domain FROM employee_code_table AS A inner join employee_salary_table AS B ON B.employee_code = A.employee_code WHERE B.employee_salary >= 30000 GROUP BY employee_domain;";
      //Query to list all employee id which has not been assigned employee code.
      $query7 = "SELECT A.employee_id FROM employee_salary_table AS A WHERE A.employee_code is NULL;";
      $all_queries = [$query1, $query2,$query3,$query4,$query5,$query6,$query7];
      //Call to a function which displays data in form of table for each query
      foreach ($all_queries as $query) {
        $table = $this->conn->query($query);
        $table = $table-> fetch_all(MYSQLI_ASSOC);
        $this->showTable($table);
      }
    }

    /**
    *
    * Display data in table format
    *
    * @param array of strings $tabledata [contains the records of a table]
    *
    * echoes the data in a table
    *
    */
    public function showTable($tabledata){
      //Flag to set table headings
      $flag_column=0;
      //Create a table
      echo "<table border=1px>";
      for($index=0;$index<count($tabledata);$index++) {
        if($flag_column==0) {
          //Table row for headings
          echo "<tr>";
          foreach($tabledata[$index] as $key=>$value) {
            echo "<th>" . $key . "</th>";
          }
          echo "</tr>";
          //Table row for values
          echo "<tr>";
          foreach($tabledata[$index] as $key=>$value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
          $flag_column=1;
        }
        //Put records in the table
        else {
          echo "<tr>";
          foreach($tabledata[$index] as $key=>$value) {
            echo "<td>" . $value . "</td>";
          }
          echo "</tr>";
        }
      }
      echo "</table>";
      echo "<br>";
    }
  }
?>
