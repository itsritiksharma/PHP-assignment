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
				$fileDest = '/var/www/PHP-assignment/TRN-18/uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDest);//moves the file to the desired location
				echo "HOLA! your file is uploaded";
								
				
				//header("Location: index.php?uploadsuccess");

			}else{
				echo "Your file is too big";
			}
		}else{
			echo "There's an error uploading your file";
		}

	}else{
		echo "You cannot upload files of this type";
	}

}

?>


<?php

//form script

 //variables for first name and last name
$nameErr=$full_name=$first_name=$last_name="";

if ($_SERVER['REQUEST_METHOD']=="POST"){
    //check if the input field is filled or not
  if (empty($_POST["firstname"])) {
    $nameErr = "First Name is required";
  } else {
    $first_name = test_input($_POST["firstname"]);
    // checks if fist name only contains letters
    if (!preg_match("/^[a-zA-Z]*$/",$first_name)) {
      $nameErr = "Only letters allowed";
    }
  }
    //check if the input field is filled or not
  if (empty($_POST["lastname"])) {
    $nameErr = "Last Name is required";
  } else {
    $last_name = test_input($_POST["lastname"]);
    // checks if last name only contains letters
    if (!preg_match("/^[a-zA-Z]*$/",$last_name)) {
      $nameErr = "Only letters allowed";
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

$full_name=$first_name." ".$last_name;

echo "<br>";

echo "Hello ".$full_name."!";

echo "<br>";
?>



<?php 

//image display script

$filename = "../TRN-18/uploads/".$fileNameNew; 

echo "<img src='".$filename."'>"

?> 

<?php
echo "<br>";
echo "Full Name: ".$full_name;
echo "<br>";
?>


<?php 
//display the textarea value
echo "<br><br>";
$result=$_REQUEST['marks'];
echo str_replace("\n","<br>",$result);
?>


<?php

$arr=$_REQUEST['phone'];

$result=strlen($arr);

if (isset($_POST['submit']))
{
	if (empty($_POST['phone']))
	{
		echo "Please enter the mobile number";
	}
	else
	{
		if (strlen($arr)!=13)
		{
			echo "Entered number is not valid";
		}
		else
		{
			//tried: .\w+[9][2-9]
			if (!preg_match("/^\+91+[6-9]\d{9}$/", $arr))
			{
				echo "Invalid mobile number";
			}
			else
			{  
				echo "Phone number: ".$arr;	
			}
			
		}
	}
}

?>