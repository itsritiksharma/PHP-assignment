<?php

  /**
  *
  * @file
  *
  * This can take user image and store it in adatabase and shows the data in a grid.
  *
  */
  namespace CreateGallery;

  class Gallery{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Upload files which have size less than 500000 to the uploads directory.
    *
    * @param array of string $file_info [array of data containing file information]
    *
    * @return file destination
    *
    */
    public function uploadFiles($file_info){
      //get the data of file
      $file=$file_info['file'];
      $fileName=$file_info['file']['name'];
      $fileSize=$file_info['file']['size'];
      $fileError=$file_info['file']['error'];
      $fileType=$file_info['file']['type'];
      $fileTmpName=$file_info['file']['tmp_name'];
      //to seperate the file name from "." and get the file extension
      $fileExt=explode('.', $fileName);
      $fileActualExt=strtolower(end($fileExt));
      //files to allow
      $allowed=array('jpg','jpeg','png');
      //check the allowed extensions actually exists in the fileExt
      if (in_array($fileActualExt,$allowed)) {
        //check for an error
        if($fileError===0) {
          //check file size
          if ($fileSize < 500000) {
            //give file a unique name with the same extension
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            //destionation of file to be upladed at
            $fileDest = '/var/www/PHP-assignment/TRN-160/PhotoGallery/uploads/'.$fileNameNew;
            //moves the file to the desired location
            move_uploaded_file($fileTmpName, $fileDest);
            return $fileNameNew;
          }
          // If there is some error echo errors.
          else {
            echo "Your file is too big";
          }
        }
        else {
          echo "There's an error uploading your file";
        }
      }
      else {
        echo "You cannot upload files of this type";
      }
    }

    /**
    *
    * Send the data into database
    *
    * @param array of string $file, string $file_destination [$file contains array  * of data of the file and $file_destination contains the destination of file]
    *
    * @return NULL
    *
    */
    public function sendDataToDatabase($file, $fileName){
      //Query to send data into the database
      $query = $this->conn->prepare("INSERT INTO Gallery (image_name, image_description)
      VALUES (?, ?);");
      $query->bind_param("ss",$fileName ,$file['description']);
      //Execute query
      $query->execute();
      return;
    }

    /**
    *
    * Retrieve filename and description from the database
    *
    * @return array of strings $grid_data [$grid_data contains filename and its
    * description]
    *
    */
    public function retrieveData(){
      // Query to retrieve file name and description
      $query = "SELECT image_name, image_description FROM Gallery;";
      $data = $this->conn->query($query);
      $grid_data = $data-> fetch_all(MYSQLI_ASSOC);
      return $grid_data;
    }
  }
?>
