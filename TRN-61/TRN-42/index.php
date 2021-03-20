<?php
	session_start();
?>

<!DOCTYPE HTML>  
<html>
	<head>
		<title>Form</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>  
		<?php include('phone.php');?>

		<p><span class="error">* required field</span></p>

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

			Enter marks: <textarea name="marks" rows="5" cols="40"></textarea>
			<br><br>

			Phone number: <input type='text' name='phone' value='+91'>
			<span class="error">* <?php echo $phoneErr;?></span>
			<br><br>

			<input type="submit" name="submit" value="Submit">  
		</form>

		<div class="pagination">
			<a href="#">&laquo;</a>
			<a href='../index2.php'>Home</a>
			<a href="../TRN-16/index.php">Assignment 1</a>
			<a href="../TRN-18/index.php">Assignment 2</a>
			<a href="../TRN-20/index.php">Assignment 3</a>
			<a href="index.php">Assignment 4</a>
			<a href="../TRN-45/index.php">Assignment 5</a>
			<a href="#">&raquo;</a>
		</div>

		<?php
			echo "<br><br>";
			echo "<a href='../logout.php'>Logout</a>";
			echo "<br><br>";
		?>
</body>
</html>

