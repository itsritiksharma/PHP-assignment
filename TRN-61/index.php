<?php
	if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])) {
		$email = $_COOKIE['email'];
		$pass = $_COOKIE['pass'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php include("validate.php");?>
		<form method="post" action="index.php" enctype="multipart/form-data">  
		  
			E-mail: <input type="text" name="log_email">
			<span class="error">* <?php echo $log_email_err;?></span>(anthony@xyz.com)
			<br><br>
			  
			Password: <input type="password" name="password">
			<span class="error">* <?php echo $passErr;?></span>(qwerty)
			<br><br>

			<input type="checkbox" name="remember" value='1'>Remember me
			<br><br>

			<input type="submit" name="submit" value="Submit">
			<br><br>

		</form>

	</body>
</html>