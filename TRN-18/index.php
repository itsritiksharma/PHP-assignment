<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  
  
  first Name: <input type="text" name="firstname" value="<?php echo $first_name;?>">
  <span class="error">* <?php echo $firstNameErr;?></span>
  <br><br>
  
  Last Name: <input type="text" name="lastname" value="<?php echo $last_name;?>">
  <span class="error">* <?php echo $lastNameErr;?></span>
  <br><br>

  Full Name: <input disabled type="text" name="fullname" value="<?php echo $full_name;?>">
  <span class="error"> <?php echo $fullNameErr;?></span>
  <br><br>

Upload file: <input type="file" name="file">
<span class="error"> <?php echo $uploadErr;?></span>
<br><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>
