<!DOCTYPE html>
<html>
<head>
  <title>Calculator</title>
  <!-- Source to Jquery script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Script to send the input variable and operator to the calc.php file -->
  <script type="text/javascript">
    function calc(){
      // Create new XMLHttpRequest object.
      var xhttp = new XMLHttpRequest();
      // Fetch the values in the selected Ids.
      var no1 = document.getElementById("input1").value;
      var no2 = document.getElementById("input2").value;
      var operator = document.getElementById("operator").value;
      // Whenever the state changes to the desired value run the function to print output.
      xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          document.getElementById("result").innerHTML = this.responseText;
        }
      }
      // Make a post request to calc.php
      xhttp.open("POST", "calc.php", true);
      // Set the headers
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      // Send the data in headers.
      xhttp.send("n1=" + no1 + "&n2=" + no2 + "&op=" + operator );
    }
  </script>
</head>
<body>
  First Input:<input type="number" name="input1" id="input1"><br>
  Second Input:<input type="number" name="input2" id="input2"><br>
  Operator:<select id="operator">
    <option>--Select An Operator--</option>
    <option>Add</option>
    <option>Subtract</option>
    <option>Multiply</option>
    <option>Divide</option>
  </select><br><br>
  <!-- On Clicking the button it calls the calc() function defined in script -->
  <button type="button" onclick="calc()">Calculate</button><br><br>
  <!-- Print the final result -->
  Result: <span id="result"></span>
</body>
</html>
