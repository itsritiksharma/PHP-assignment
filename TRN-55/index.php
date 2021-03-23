<!DOCTYPE HTML>  
<html>
	<head>
		<title>Form</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>  
		<?php include('doc.php');?>

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

			Enter marks: <textarea name="marks" rows="5" cols="40"></textarea>
			<br><br>

			Upload file: <input type="file" name="file">
			<span class="error"> <?php echo $uploadErr;?></span>
			<br><br>

			Phone number: <input type='text' name='phone' value='+91'>
			<span class="error">* <?php echo $phoneErr;?></span>
			<br><br>

			E-mail: <input type="text" name="email" value="<?php echo $email;?>">
			<span class="error">* <?php echo $emailErr;?></span>
			<br><br>

			<input type="submit" name="submit" value="Submit" id="btn">
			<br><br>

		</form>
		<script>
			document.getElementById("btn").addEventListener("click", submitClicked);
			function submitClicked() 
				{
				  	var a = document.createElement("a");
					  a.href = "details.doc";
					  a.setAttribute("download", 'details.doc');
					  a.click();
				} 
		</script>
		<?php include('out.php');?>
	</body>
</html>
