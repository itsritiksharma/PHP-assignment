<?php
	session_start();
	session_destroy();
	echo "Yout successfully logout. Click here to login again <a href = 'index.php'>login again</a>";
	if(isset($_COOKIE['email']) and isset($_COOKIE['pass'])) {
		$email = $_COOKIE['email'];
		$pass = $_COOKIE['pass'];
		setcookie('email', $email, time() -1);
		setcookie('password', $email, time() -1);
	}

