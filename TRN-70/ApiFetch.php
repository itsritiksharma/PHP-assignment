<?php
  namespace ComposerNew;
  require './vendor/autoload.php';
  use GuzzleHttp\Client;
  class ApiFetch {
    public $url;
    public $img;
    public $service;
    public $BASE_URL = "https://www.innoraft.com";
    // public $client = new Client(['base_uri' => 'https://www.innoraft.com/']);
    function serviceImageFetch($service_img) {
      $main_array = array();
      for($service_img_index=0;$service_img_index<count($service_img);$service_img_index++)
      {
        $api = array();
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('GET',$service_img[$service_img_index]);
        $api_content = $response->getBody();
        $json_data = json_decode($api_content);
        for($i=0;$i<count($json_data->data);$i++)
        {
          $client = new Client(['base_uri' => $url]);
          $response = $client->request('GET',$json_data->data[$i]->relationships->field_media_image->links->related->href);
          $icon_image_response = $response->getBody();
          $icon_image_json_data = json_decode($icon_image_response);
          $image_url = $icon_image_json_data->data->attributes->uri->url;
          array_push($api,$image_url);
        }
        array_push($main_array,$api);
      }
      return $main_array;
    }
    function fetchAll($img_url_array) {
      $result = array();
      foreach($img_url_array as $a)
      {
        $image_url = $this->imgfetch($a);
        array_push($result,$image_url);
      }
      return $result;
    }
    function imgfetch($img) {
      $this->img = $img;
      $client = new Client(['base_uri' => $url]);
      $response = $client->request('GET',$img);
      $api_content = $response->getBody();
      $json_data   = json_decode($api_content);
      $node1 = $json_data->data->attributes->uri->url;
      return $node1;
    }
    function getcontent($url) {
      $this->url = $url;
      $client = new Client(['base_uri' => $url]);
      $response = $client->request('GET','jsonapi/node/services');
      $body = $response->getBody();
      $json_data = json_decode($body);
      $data = $json_data->data;
      $data = array_slice($data,12, 15);
      for ($i=count($data)-1;$i>=0;$i--)
      {
        $headings[$i] = $data[$i]->attributes->field_secondary_title->value;
        $list[$i] = $data[$i]->attributes->field_services->value;
        $api2[$i] = $data[$i]->relationships->field_image->links->related->href;
        $alias[$i] = $data[$i]->attributes->path->alias;
        $service_api[$i] = $data[$i]->relationships->field_service_icon->links->related->href;
      }
      $image_urls = $this->fetchAll($api2);
      $service_url = $this->serviceImageFetch($service_api);
      for($service_url_index=0;$service_url_index<count($service_url);$service_url_index++)
      {
        for($service_url_index2=0;$service_url_index2<count($service_url[$service_url_index]);$service_url_index2++)
        {
          $service_url[$service_url_index][$service_url_index2]='<img class="service-icon"  src="'.$this->BASE_URL.$service_url[$service_url_index][$service_url_index2].'">';
        }
      }
      for($i=0;$i<count($image_urls);$i++)
      {
        $images[$i] = '<img src="'.$this->BASE_URL.$image_urls[count($image_urls)-$i-1].'">';
      }
      for($i=0;$i<count($data);$i++)
      {
        $actual_data[$i] = [
        $headings[count($headings)-$i-1],
        $list[count($list)-$i-1],
        $images[count($images)-$i-1],
        $service_url[count($service_url)-$i-1]
        ];
      }
      return $actual_data;
    }
  }
?>
