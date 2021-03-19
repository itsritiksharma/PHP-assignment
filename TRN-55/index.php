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

			<a href="download.php?file=details.doc">Download details</a>

			<input type="submit" name="submit" value="Submit">  
		</form>

		<?php

			if (isset($_POST['submit']))
				{
					$accessKey='2838541c68587385fa05e5ec91828728';

					$email_address='support@apilayer.com';

					$ch = curl_init('http://apilayer.net/api/check?access_key='.$accessKey.'&email='.$email.''); 

	 				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					// Store the data:
					$json = curl_exec($ch);

					curl_close($ch);

					// Decode JSON response:
					$validationResult = json_decode($json, true);

					// Access and use your preferred validation result objects
					if ($validationResult['format_valid'] == true)
						{
							echo "Email id is: ".$email;
						}

					else
						{
							$emailErr="Email not valid";
						}
					// $validationResult['smtp_check'];
					// $validationResult['score'];
				  
					if (!($first_name&&$last_name&&$email))
						{
							echo "Please fill all the details";
						}

					else
						{

					  		echo "<br><br>";
					        echo "Hello ".$full_name."!";
					        echo "<br><br>";
					        
					        echo "Phone number is: ".$phone;

					        echo "<br><br>";
					 		$result=$_POST['marks'];
							foreach(explode("\n", $result) as $x)
								{
								  	$y[]=explode('|',$x);
								}

							echo "<table border=1; cellspacing=0>";
							for($z=0;$z<count($y);$z++)
								{
								  	echo "<tr>";
								  	echo "<td>".$y[$z][0]."</td>";
								  	echo "<td>".$y[$z][1]."</td";
								  	echo "</tr>";
								}
							echo "</table>";

							$file=$_FILES['file'];
							$fileName=$_FILES['file']['name'];
							$fileSize=$_FILES['file']['size'];
							$fileError=$_FILES['file']['error'];
							$fileType=$_FILES['file']['type'];
							$fileTmpName=$_FILES['file']['tmp_name'];

							//to seperate the file name from "." and get the file extension
							$fileExt=explode('.', $fileName);
							$fileActualExt=strtolower(end($fileExt));

							//files to allow
							$allowed=array('jpg','jpeg','png');

							//check the allowed extensions actually exists in the fileExt
							if (in_array($fileActualExt,$allowed))
								{
									//check for an error
									if($fileError===0)
										{
											//check file size
											if ($fileSize < 500000)
												{
													//give file a unique name with the same extension
													$fileNameNew = uniqid('',true).".".$fileActualExt;

													//destionation of file to be upladed at
													$fileDest = '/var/www/PHP-assignment/TRN-55/uploads/'.$fileNameNew;
													move_uploaded_file($fileTmpName, $fileDest);//moves the file to the desired location
												}
											else
												{
													$uploadErr = "Your file is too big";
												}
										}
									else
										{
											$uploadErr = "There's an error uploading your file";
										}
								}
							else
								{
									$uploadErr = "You cannot upload files of this type";
								}
					  	} 

				  	$file=fopen("details.doc","w+") or die("Unable to open file");
				  	fwrite($file,$full_name);
				  	fwrite($file,$email);
				  	fwrite($file,$phone);
				  	fclose($file);

					$fileDest = '/var/www/PHP-assignment/TRN-55/'.$file;
					move_uploaded_file($file, $fileDest);

					if (!empty($_Get['file']))
						{
							if (!empty($file) && file_exists($fileDest)) 
								{
									header('Content-Description: File Transfer');
									header('Content-Type: application/zip');
									header('Content-Disposition: attachment; filename="'.basename($file).'"');
									header('Expires: 0');
									header('Cache-Control: public');
									header('Pragma: public');
									header('Content-Length: ' . filesize($file));
									readfile($fileDest);
									exit;
								}
						}

					//image display script
					$filename = "uploads/".$fileNameNew; 
					echo "<img class='image' src='".$filename."'>";
				}
		?>

	</body>
</html>
