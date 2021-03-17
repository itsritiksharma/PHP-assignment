<?php
// define variables and set to empty values
$firstNameErr = $lastNameErr =$emailErr = $phoneErr =$fullNameErr = $uploadErr = "";
$first_name = $last_name =$full_name = $email = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["firstname"])) 
  {
    $firstNameErr = "first name is required";
  }
  elseif(preg_match('/^[^ ].* .*[^ ]$/',$first_name))
  {
    echo "First Name not valid!";
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
    echo "Last name not valid!";
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



  if (empty($_POST["email"]))
  {
    $emailErr = "Email is required";
  } 
  else 
    {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      {
        $emailErr = "Invalid email format";
      }
    }

  if (empty($_POST['phone']))
  {
    $phoneErr = "Phone number required";
  }
  else
  {
    $arr=$_REQUEST['phone'];
    if (strlen($arr)!=13)
    {
      $phoneErr = "Entered number is not valid";
    }
    else
    {
      //tried: .\w+[9][2-9]
      if (!preg_match("/^\+91+[6-9]\d{9}$/", $arr))
      {
        $phoneErr = "Invalid mobile number";
      }
      else
      {  
        $phone = test_input($_POST['phone']); 
      }
      
    }
  }

  // $file=$_FILES['file'];

  // $fileName=$_FILES['file']['name'];
  // $fileSize=$_FILES['file']['size'];
  // $fileError=$_FILES['file']['error'];
  // $fileType=$_FILES['file']['type'];
  // $fileTmpName=$_FILES['file']['tmp_name'];

  // //to seperate the file name from "." and get the file extension
  // $fileExt=explode('.', $fileName);
  // $fileActualExt=strtolower(end($fileExt));

  // //files to allow
  // $allowed=array('jpg','jpeg','png');

  // //check the allowed extensions actually exists in the fileExt
  // if (in_array($fileActualExt,$allowed)){

  //   //check for an error
  //   if($fileError===0){


  //     //check file size
  //     if ($fileSize < 500000){

  //       //give file a unique name with the same extension
  //       $fileNameNew = uniqid('',true).".".$fileActualExt;

  //       //destionation of file to be upladed at
  //       $fileDest = '/var/www/PHP-assignment/TRN-45/uploads/'.$fileNameNew;
  //       move_uploaded_file($fileTmpName, $fileDest);//moves the file to the desired location

  //     }else{
  //       $uploadErr = "Your file is too big";
  //     }
  //   }else{
  //     $uploadErr = "There's an error uploading your file";
  //   }

  // }else{
  //   $uploadErr = "You cannot upload files of this type";
  // }

  // } 

}


function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!--Output first name, last name and email-->

<?php

// if (isset($_POST['submit']))
// {
  
//   if (!($first_name&&$last_name&&$email))
//   {
//     echo "Please fill all the details";
//   }
//   else
//   {
//           $full_name=$first_name." ".$last_name;
//           echo "Hello ".$full_name."!";
//           echo "<br><br>";
//           echo "Email id is: ".$email;
//           echo "<br><br>";
//           echo "Phone number is: ".$phone;
      
//   } 

// }
// ?>

