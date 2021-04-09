<?php

  /**
  *
  * @file
  *
  * The system to take input data from users and send mail to the user and owner.
  *
  * This will take data from user in HTML form and store the data of user in
  * the database and send a mail to the owner of websit and user.
  *
  */

  namespace UserForm;

  require './vendor/autoload.php';

  use PHPMailer\PHPMailer\PHPMailer;

  use PHPMailer\PHPMailer\SMTP;

  class User{
    public $conn;
    //create connection
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Sends data to the database
    *
    * @param array of strings $data [data input by of the user in the form]
    *
    * @return returns to the object.
    *
    */
    public function sendData($data){
      //Send data into database
      $query1 = $this->conn->prepare("INSERT INTO user_data_table (user_name, user_mail, user_message)
      VALUES (?, ?, ?);");
      $query1->bind_param("sss",$data['Name'],$data['Email'],$data['message']);
      $query1->execute();
      return;
    }

    /**
    *
    * Send mail to user and owner
    *
    * @param array of strings $userData [containing data of user from form]
    *
    * echoes if the mail is sent
    *
    */
    public function sendMail($userData){
      $mail = new PHPMailer(true);
      // Set mailer to use SMTP
      $mail->isSMTP();
      // Specify main and backup SMTP servers
      $mail->Host = 'smtp.gmail.com';
      // Enable SMTP authentication
      $mail->SMTPAuth = true;
      // SMTP username
      $mail->Username = 'owner@gmail.com';
      // SMTP password
      $mail->Password = 'password';
      $mail->Port = 587;
      $mail->From = 'owner@gmail.com';
      $mail->FromName = 'Name';
      // Add a recipient
      $mail->addAddress(''.$userData['Email'].'');
      // Set email format to HTML
      $mail->isHTML(true);
      // Mail data to be sent
      $mail->Subject = 'Thank you for contacting Domain';
      $mail->Body = 'Thanks for getting in touch. Your message has been received and will be processed as soon as possible.';
      if(!$mail->send()) {
        //Throw error if there's one
        echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        echo "Mail has been sent successfully!";
        //Send mail to the owner from user
        $mail->From = $userData['Email'];
        $mail->FromName = 'Uname';
        //Now receipient is owner
        $mail->addAddress('owner@gmail.com');
        // Set email format to html
        $mail->isHTML(true);
        $mail->Subject = 'User mail';
        // Mail body is message
        $mail->Body = $userData['message'];
      }
    }
  }
?>
