<?php
  namespace Composer;
  require './vendor/autoload.php';
  use GuzzleHttp\Client;
    class apifetch {
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
        // echo $node1;
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
        $this->dataprint($headings,$list,$images,$service_url);
      }
      function dataprint($head,$lists,$image,$service_urls) {
        echo '<div class="content">';
        for($i=count($head)-1;$i>=0;$i--)
        {
          echo '<div class="row">';
          echo '<div class="image">';
          echo $image[$i];
          echo '</div>';
          echo '<div class="service-rv--content">';
          echo '<div class="main_content">';
          echo $head[$i];
          echo '<div class="service-icon">';
          for($image_index=0;$image_index<count($service_urls[$i]);$image_index++){
            echo $service_urls[$i][$image_index];
          }
          echo '</div>';
          echo '<div class="service-list">';
          echo $lists[$i];
          echo '</div>';
          echo '<div class="cta-link"><a class="btn" href="/services/web-design-development">Explore More</a></div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        echo '</div>';
      }
    }
  echo '<div class="container">';
  echo '<div class="header">';
  echo 'Innoraft has been successfully delivering web and mobile solutions to esteemed global clientele. Our key solutions include website design and development, Drupal development and maintenance, mobile app design and development, and E-Commerce solutions. The quality-driven processes for all these services is our USP and we live by them every single day. We love to work with startups, small, medium, and large scale enterprises in the same way i.e. as partners';
  echo '</div>';
  $url = 'https://www.innoraft.com/';
  $response = new apifetch();
  $response->getcontent($url);
  // echo '</div>';
