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
