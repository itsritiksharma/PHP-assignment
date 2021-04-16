<?php

  //config.php

  //Include Google Client Library for PHP autoload file
  require_once './vendor/autoload.php';

  //Make object of Google API Client for call Google API
  $google_client = new Google_Client();

  //Set the OAuth 2.0 Client ID
  $google_client->setClientId('864915354096-iuul38nrp6rmpph7p9s3djui22nbvb6g.apps.googleusercontent.com');

  //Set the OAuth 2.0 Client Secret key
  $google_client->setClientSecret('j2nlXWE6Ieeg8o7bMWTcp-xQ');

  //Set the OAuth 2.0 Redirect URI
  $google_client->setRedirectUri('http://localhost/TRN-177/index.php');

  $google_client->addScope('email');

  $google_client->addScope('profile');

  //start session on web page
  session_start();

?>
