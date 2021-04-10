<?php

  /**
  *
  * @file
  *
  * Make a GET request to http://api.giphy.com/v1/gifs/ with an api key to get a
  * random gif, store the gif in a database and return the gif URL to display.
  *
  */

  namespace GiphyApi;

  require './vendor/autoload.php';

  use GuzzleHttp\Client;

  class Giphy{
    public $conn;
    // Set connection variable
    public function __construct($conn){
      $this->conn = $conn;
    }

    /**
    *
    * Make a get request to the giphy api to fetch random gif
    *
    * @param NULL
    *
    * @return URL of the gif
    *
    */
    public function getRandomGif() {
      // Make a new client
      $client = new Client(['base_uri' => 'http://api.giphy.com/v1/gifs/']);
      // Make a GET request to the giphy API
      $response = $client->request('GET', 'random?api_key=5nxUylQYwTktf5HAODQXgje4dmTc0ZNP');
      // Get response body
      $body = $response->getBody();
      // Decode it into json format
      $gif = json_decode($body);
      // Access the gif url
      $randomGifUrl = $gif->data->image_url;
      // Store the url in a database
      $this->sendDataToDatabase($randomGifUrl);
      return $randomGifUrl;
    }

    /**
    *
    * Save gif URL in the database.
    *
    * @param string $gif_url [url of the gif]
    *
    * @return NULL
    *
    */
    public function sendDataToDatabase($gifUrl){
      //Query to send data into the database
      $query = $this->conn->prepare("INSERT INTO Giphs (image_url)
      VALUES (?);");
      $query->bind_param("s",$gifUrl);
      //Execute query
      $query->execute();
      return;
    }
  }
?>
