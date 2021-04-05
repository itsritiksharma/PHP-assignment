<?php
  namespace GithubGists;
  require './vendor/autoload.php';
  use GuzzleHttp\Client;
  class Github{
    function SendDataToGist($code){
      $auth = "authToken";
      ini_set('user_agent', "PHP");
      $body = json_encode(array(
        'description' => 'New gist',
        'public' => 'false',
        'files' => array('Newss.txt' => array('content' => $code))
        ));
      $headers = ['headers'=>array(
        'Authorization' => 'token '.$auth),
        'body' => $body];
      $url = 'https://api.github.com/gists';
      $client = new \GuzzleHttp\Client();
      $response = $client->request('POST', $url, $headers);
      $gist = json_decode($response -> getBody());
    }
  }
?>
