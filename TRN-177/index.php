<?php
session_start();
require_once './vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$consumerkey = "DpLfksh6ILGsrhaFrGZDRzP7C";
$consumersecret = "S6USB5tLL7FkxOb8CZQ5DsKxORfFSk6BaZ5Dbw4sNZIdkc4k4y";
$accesstoken = "1189279002-1n5JANhMdbYdLeSoyHpwxiDxLmBlxr45wP0VO8G";
$accesstokensecret = "QdYhnPt92J8R1v3g2JwZUN6wodeQFzhP7GUWIy5sKnRAZ";

function getToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}

$connection = getToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$content = $connection->get("account/verify_credentials");

$statuses = $connection->get("statuses/home_timeline", ["count" => 2, "exclude_replies" => true]);

print('<pre>' . print_r($statuses,true) . '</pre>');
?>
