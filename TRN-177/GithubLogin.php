<?php
  namespace GithubGists;
  require './vendor/autoload.php';
  use GuzzleHttp\Client;
  class Github{
    function SendData($code){
      // $auth = "authToken";
      ini_set('user_agent', "PHP");
      $headers = ['form_params'=>array(
        'client_id' => '7ceee2bb6300dd2fab8a',
      'client_secret' => '888d696e30d904898b3c44793d7577bf84f11481',
      'code' => $code,
      'redirect_uri' => 'http://localhost/TRN-177/index.php')];
      $url = 'https://github.com/login/oauth/access_token';
      $client = new \GuzzleHttp\Client();
      $response = $client->request('POST', $url, $headers);
      $gist = json_decode($response -> getBody());
      echo $gist;
    }
  }
?>
