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
    }


  function test_input($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

