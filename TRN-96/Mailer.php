<?php
  namespace MailSpace;
  require './vendor/autoload.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  class Mailer{
    function Sendmail(){
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'user@gmail.com';                 // SMTP username
        $mail->Password = 'password';                           // SMTP password
        $mail->Port = 587;
        $mail->From = 'from@gmail.com';
        $mail->FromName = 'gmail';
        $mail->addAddress(''.$_POST['email'].'');     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Thank you for contacting Domain';
        $mail->Body = 'Thanks for getting in touch. Your message has been received and will be processed as soon as possible.';
        if(!$mail->send()) {
           //Finally redirect
                echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Mail has been sent successfully!";
        }
    }
  }
