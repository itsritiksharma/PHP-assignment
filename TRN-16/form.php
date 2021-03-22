<?php
// define variables and set to empty values
  $firstNameErr = $lastNameErr = "";
  $first_name = $last_name =$full_name = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if (empty($_POST["firstname"])) 
        {
          $firstNameErr = "first name is required";
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
      else 
        {
          $last_name = test_input($_POST["lastname"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z]*$/",$last_name)) 
            {
              $lastNameErr = "Only letters allowed";
            }
        }
    }

    if (isset($_POST['submit']))
      {
        if (preg_match('/^[^ ].* .*[^ ]$/',$first_name))
          {
            echo "Name not valid!";
          }
        else
          {
            $full_name=$first_name." ".$last_name;
            echo "Hello ".$full_name."!";
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