<?php

//form script

 //variables for first name and last name
$firstNameErr = $lastNameErr =$fullNameErr = $uploadErr = "";
$first_name = $last_name =$full_name = "";

if ($_SERVER['REQUEST_METHOD']=="POST"){
    //check if the input field is filled or not
  if (empty($_POST["firstname"])) 
    {
      $firstNameErr = "first name is required";
    }
  elseif(preg_match('/^[^ ].* .*[^ ]$/',$first_name))
    {
      $firstNameErr = "First Name not valid!";
    }
  else 
    {
      $first_name = test_input($_POST["firstname"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z]*$/",$first_name)) 
      {
        $firstNameErr = "Only letters allowed";
      }
    }

  if (empty($_POST["lastname"])) 
    {
      $lastNameErr = "last name is required";
    } 
  elseif(preg_match('/^[^ ].* .*[^ ]$/',$last_name))
    {
      $lastNameErr = "Last name not valid!";
    }
  else 
  {
    $last_name = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z]*$/",$last_name)) 
    {
      $lastNameErr = "Only letters allowed";
    }
    else
    {
        $full_name=$first_name." ".$last_name;

    }
  }

}

//function for test input

function test_input($data){
  $data=trim($data);
  return $data;
}

?>


<?php
//file upload script

//check if the file is submitted
if (isset($_POST['submit'])) {

	//get the data of file 
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
	if (in_array($fileActualExt,$allowed)){

		//check for an error
		if($fileError===0){


			//check file size
			if ($fileSize < 500000){

				//give file a unique name with the same extension
				$fileNameNew = uniqid('',true).".".$fileActualExt;

				//destionation of file to be upladed at
				$fileDest = '/var/www/PHP-assignment/TRN-61/uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDest);//moves the file to the desired location

				$full_name=$first_name." ".$last_name;
								
				
				//header("Location: index.php?uploadsuccess");

			}else{
				$uploadErr = "Your file is too big";
			}
		}else{
			$uploadErr = "There's an error uploading your file";
		}

	}else{
		$uploadErr = "You cannot upload files of this type";
	}

}

?>

