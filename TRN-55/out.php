
<?php
if (isset($_POST['submit']))
{
					// $accessKey='2838541c68587385fa05e5ec91828728';

					// $email_address='support@apilayer.com';

					// $ch = curl_init('http://apilayer.net/api/check?access_key='.$accessKey.'&email='.$email.'');

	 			// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					// // Store the data:
					// $json = curl_exec($ch);

					// curl_close($ch);

					// // Decode JSON response:
					// $validationResult = json_decode($json, true);

					// // Access and use your preferred validation result objects
					// if ($validationResult['format_valid'] == true)
					// 	{
					// 		echo "Email id is: ".$email;
					// 	}

					// else
					// 	{
					// 		$emailErr="Email not valid";
					// 	}
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
						                 // $file=fopen("details.doc","w+") or die("Unable to open file");
										  	//fwrite($file,' Full name:'.$full_name.' Email id:'.$email.'\n Phone no.:'.$phone.'\n');
						                // fclose($file);
										  	//$img = 'uploads/'.$fileNameNew;
										  	//$content = file_get_contents('/var/www/PHP-assignment/TRN-55/details.doc');
										  	//$fi = $content.$img;
										  	//file_get_contents('/var/www/PHP-assignment/TRN-55/details.doc');
										  	//file_put_contents('/var/www/PHP-assignment/TRN-55/details.doc', $fi);
						                 $file=fopen("image.doc","w+") or die("Unable to open file");
						                 $lamp = file_get_contents('uploads/'.$fileNameNew);
						                 file_put_contents('/var/www/PHP-assignment/TRN-55/image.doc', $lamp);
						                 fclose($file);

						                 $file2=fopen("details.doc","w+") or die("unabel to open file");
						                 fwrite($file2,' Full name:'.$full_name.' Email id:'.$email.' Phone no.:'.$phone);
						                 //$content = file_get_contents('/var/www/PHP-assignment/TRN-55/details.doc');
						                 //file_get_contents('/var/www/PHP-assignment/TRN-55/details.doc');
										  	//file_put_contents('/var/www/PHP-assignment/TRN-55/details.doc', $fi);
						                 fclose($file2);
										  	//$file=fopen("details.docx","a+") or die("Unable to open file");
										  	//file_put_contents('/var/www/PHP-assignment/TRN-55/details.docx', "hello ff", FILE_APPEND);//
						         //fclose($file);
											// $fileDest = '/var/www/PHP-assignment/TRN-55/'.$file;
											// move_uploaded_file($file, $fileDest);

											//image display script
											//$filename = "uploads/".$fileNameNew;
											//echo "<img class='image' src='".$filename."'>";

						                 $filename = "details.doc";

						                 header('Content-Type: application/vnd.ms-word');
						                 header("Content-Disposition: attachment; filename=$filename");

						                 echo "<html><body><img src='/var/www/PHP-assignment/TRN-55/uploads/".$fileNameNew."' style='width:300px;height: 300px;'/></body></html>";

						                 // echo "<br><br>";
						                 // echo "<a href='download.php?file=details.doc'>Download details</a>";
						}
               
?>
