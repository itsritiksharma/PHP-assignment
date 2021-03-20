<?php
    session_start();
?>

<!DOCTYPE HTML>  
<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>  
        <?php include('function.php');?>

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
              
            <input type="submit" name="submit" value="Submit">  
        </form>

        <?php

            if (isset($_POST['submit']))
                {
                  
                    if (!($first_name&&$last_name))
                        {
                            echo "<br><br>";
                            echo "Please fill all the details";
                            echo "<br><br>";
                        }

                    else
                        {
                            echo "<br><br>";
                            echo "Hello ".$full_name."!";
                            echo "<br><br>";
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
                                                    $fileDest = '/var/www/PHP-assignment/TRN-61/uploads/'.$fileNameNew;
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
                            //image display script
                            $filename = "../uploads/".$fileNameNew; 
                            echo "<img class='image' src='".$filename."'>";
                        } 
                }
        ?>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href='../index2.php'>Home</a>
            <a href="../TRN-16/index.php">Assignment 1</a>
            <a href="../TRN-18/index.php">Assignment 2</a>
            <a href="index.php">Assignment 3</a>
            <a href="../TRN-42/index.php">Assignment 4</a>
            <a href="../TRN-45/index.php">Assignment 5</a>
            <a href="../TRN-55/index.php">Assingment 6</a>
            <a href="#">&raquo;</a>
        </div>

        <?php
            echo "<br><br>";
            echo "<a href='../logout.php'>Logout</a>";
            echo "<br><br>";
        ?>

    </body>
</html>