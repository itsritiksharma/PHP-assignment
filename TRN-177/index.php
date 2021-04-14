<!DOCTYPE html>
<html>
<head>
  <title>Form</title>
  <!-- Source to Jquery scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
  <!-- Script to send the input Database.php file -->
  <script type="text/javascript">
    function database(){
      // Create new XMLHttpRequest object.
      var xhttp = new XMLHttpRequest();
      // Fetch the values of the selected Ids.
      var email = document.getElementById("email").value;
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      var randstring = "jakhailohakalbialakdbv";
      // Encrypt the password with AES encryption using random string.
      var encrypted = CryptoJS.AES.encrypt(randstring, password);
      var encpass =encrypted;
      // Whenever the state changes to the desired value run the function to print output.
      xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          document.getElementById("result").innerHTML = this.responseText;
        }
      }
      // Make a post request to Database.php
      xhttp.open("POST", "Database.php", true);
      // Set the headers
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      // Send the data in headers.
      xhttp.send("email=" + email + "&username=" + username + "&password=" + encpass);
    }
  </script>
</head>
<body>
  Email: <input type="email" name="email" id="email"><br>
  Username: <input type="text" name="username" id="username"><br>
  Password: <input type="password" name="password" id="password"><br>
  <!-- Call database function on click -->
  <button type='button' onclick="database()">Submit</button>
  <!-- Display result -->
  <div id='result'></div>
</body>
</html>
