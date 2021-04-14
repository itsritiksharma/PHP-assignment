<?php
session_start();
require_once './vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$consumerkey = "Ckey";
$consumersecret = "Csecret";
$accesstoken = "Atoken";
$accesstokensecret = "ATsecret";

function getToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}

$connection = getToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$content = $connection->get("account/verify_credentials");

$statuses = $connection->get("statuses/home_timeline", ["count" => 2, "exclude_replies" => true]);

print('<pre>' . print_r($statuses,true) . '</pre>');
?>
