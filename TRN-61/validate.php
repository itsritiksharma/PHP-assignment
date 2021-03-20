<?php
	$myemail = "anthony@xyz.com";
	$mypass = "qwerty";
	if(isset($_POST['submit'])) {
		$email = $_POST['log_email'];
		$pass = $_POST['password'];
		if($email == $myemail && $pass == $mypass) {
			if(isset($_POST['remember'])) {
				setcookie('email', $email, time() + 60*60*7);
				setcookie('password', $email, time() + 60*60*7);
			}
			session_start();
			$_SESSION['email'] = $email;
			header("location: index2.php");
		} else {
			echo "E-mail or password is invalid.<br> click here to <a href = 'login.php'> try again </a>";
		}
	} else {
		header("lcoation: login.php");
	}
?>