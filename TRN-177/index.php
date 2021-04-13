<!DOCTYPE html>
<html>
<head>
  <title>Calculator</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    function calc(){
      var xhttp = new XMLHttpRequest();
      var no1 = document.getElementById("input1").value;
      var no2 = document.getElementById("input2").value;
      var operator = document.getElementById("operator").value;

      xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          document.getElementById("status").innerHTML = this.responseText;
        }

      xhttp.open("POST", "calc.php", true);
      xhttp.setRequestHeader("Content-type","application/x-www-from-urlencoded");
      xhttp.send("n1=" + no1 + "&n2=" + no2 + "&op=" + operator);
    }
  </script>
</head>
<body>
  First Input:<input type="number" name="input1" id="input1"><br>
  Second Input:<input type="number" name="input2" id="input2"><br>
  Operator:<select id="operator">
    <option>--Select An Operator--</option>
    <option>+</option><br/>
    <option>-</option>
    <option>*</option>
    <option>/</option>
  </select><br><br>
  <!-- <button type="button" onclick="window.calc(); return false;">Calculate</button> -->
  <button type="button" onclick="calc()">Calculate</button>
  <div id="status"></div>
</body>
</html>
