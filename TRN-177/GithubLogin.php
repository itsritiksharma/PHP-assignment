<?php

  session_start();
  require_once './vendor/autoload.php';
  require_once 'database.php';

  $provider = new League\OAuth2\Client\Provider\Github([
    'clientId'          => '7ceee2bb6300dd2fab8a',
    'clientSecret'      => '888d696e30d904898b3c44793d7577bf84f11481',
    'redirectUri'       => 'http://localhost/TRN-177/GithubLogin.php',
  ]);
  // var_dump($_SESSION);
  if (!isset($_GET['code'])) {
    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;
  // Check given state against previously stored one to mitigate CSRF attack
  }
  elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
  }
  else {
    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);
    // Optional: Now you have a token you can look up a users profile data
    try {
      // We got an access token, let's now get the user's details
      $user = $provider->getResourceOwner($token);
      // Convert the data into array.
      $userdata = $user->toArray();
      // Display user profile.
      echo "<html>";
      echo "<head>";
      echo "<title>Github</title>";
      echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
      echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />';
        echo "<div class='container'>";
            echo '<div class="panel panel-default">';
              echo '<div class="panel-heading">Github profile</div><div class="panel-body">';
              // fetch the image of the account to whom tweet belongs.
              echo '<img src="' . $userdata['avatar_url'] . '" class="img-responsive img-circle img-thumbnail" style="width:100px" />';
              // Fetch username and their twitter handle.
              echo '<h3><b>username :</b> ' . $userdata['login'] . '</h3>';
              // Fetch the tweet.
              echo '<h3><b> Following:</b> ' . $userdata['following'].'</h3>';
              // Fetch the count of likes and retweets.
              echo '<span><b>Public repos:</b> ' . $userdata['public_repos'] .'  <b>Github Profile:</b> <a href="' . $userdata['html_url'] . '">itsritiksharma</a></span>';
              echo '</div>';
              $user = new data();
              $gitUser = $user->checkUserGit($userdata);
            echo "</div>";
        echo "</div>";
      echo "</html>";
    } catch (Exception $e) {
      // Failed to get user details
      exit('Oh dear...');
    }
  }
?>
