<?php

  /**
  *
  * @file
  *
  * Fetch the tweets from a account whose auth keys are provided and display them on the screen.
  *
  */
  session_start();

  require_once './vendor/autoload.php';

  use Abraham\TwitterOAuth\TwitterOAuth;
  // Set all the auth tokens
  $consumerkey = "ckey";
  $consumersecret = "csecret";
  $accesstoken = "atoken";
  $accesstokensecret = "atsecret";
  //function to create a new TwitterOAuth object
  function getToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
  }
  // Call the function with all the tokens.
  $connection = getToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
  // Verify account.
  $content = $connection->get("account/verify_credentials");
  // Get 5 tweets from the home timeline.
  $statuses = $connection->get("statuses/home_timeline", ["count" => 5, "exclude_replies" => true]);
  // Show the tweets in eye pleasing way.
  echo "<html>";
    echo "<head>";
    echo "<title>Tweeter</title>";
    echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
    echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />';
    echo "<div class='container'>";
      foreach($statuses as $status){
        echo '<div class="panel panel-default">';
          echo '<div class="panel-heading">Tweet</div><div class="panel-body">';
          // fetch the image of the account to whom tweet belongs.
          echo '<img src="' . $status->user->profile_image_url . '" class="img-responsive img-circle img-thumbnail" />';
          // Fetch username and their twitter handle.
          echo '<h3><b>Name :</b> ' . $status->user->name . ' @' . $status->user->screen_name . '</h3>';
          // Fetch the tweet.
          echo '<h3><b>Tweet :</b> ' . $status->text.'</h3>';
          // Fetch the count of likes and retweets.
          echo '<span><b>Likes:</b> ' . $status->favorite_count .'  <b>Retweet:</b> ' . $status->retweet_count . '</span>';
          echo '</div>';
        echo "</div>";
      }
    echo "</div>";
  echo "</html>";
?>
