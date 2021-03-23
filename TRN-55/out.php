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
				    $fileNameNew = '';

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
         	$message = "<html>
             				<body>
             					<h2>Full name: ".$full_name."</h2>
             					<h2>Email: ".$email."</h2>
             					<h2>Table</h2><br>
									<table border='1'>
									<thead>
									<tr>
									<th>Subject Name</th>
									<th> Marks</th>
									</tr>
									</thead>
									<tbody>";
									
									for($i=0;$i<count($y);$i++)
										{
										  $message .="
										  <tr>
										  <td>" .$y[$i][0]. "</td>
										  <td>" .$y[$i][1]. "</td>
										  </tr>";
										}
									$message .="
									</tbody>
									</table>	
								<img src ='/var/www/PHP-assignment/TRN-55/uploads/".$fileNameNew."' style='width:200px;height:200px'>
							</body>
					  	</html>";

         	$file2=fopen("details.doc","w+") or die("unabel to open file");
         	fwrite($file2, $message);				                
         	fclose($file2);
		}
?>