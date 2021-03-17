
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  


<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">  
  first Name: <input type="text" name="firstname" value="<?php echo $name;?>">
  <span class="error">* <?php echo $firstNameErr;?></span>
  <br><br>
  
  Last Name: <input type="text" name="lastname" value="<?php echo $name;?>">
  <span class="error">* <?php echo $lastNameErr;?></span>
  <br><br>

  Full Name: <input disabled type="text" name="fullname" value="<?php echo $full_name;?>">
  <span class="error">* <?php echo $fullameErr;?></span>
  <br><br>


  <input type="submit" name="submit" value="Submit">  
</form>

<?php include('form.php');?>

</body>
</html>
