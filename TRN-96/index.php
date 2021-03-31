
<!DOCTYPE html>
<html>
<head>
  <title>Thank you mail</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method='post'>
    Email:<input type='email' name='email'>
    <input type='submit' name='submit' value='Submit'>
  </form>
</body>
</html>
<?php
    include ('mail.php');
    use MailSpace\Mailer as Mailer;
    if (isset($_POST['submit'])){
      $new_mail = new Mailer();
      $send_mail = $new_mail->Sendmail();
    }
?>
