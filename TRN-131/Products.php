<?php
  namespace AllProducts;
  class Products{
    public $products;
    function __construct($Products){
      $this->products = $Products;
    }
    function ProductData(){
      foreach($this->products as $key=>$value) {
        $sort_pd[] = $value['pd'];
        $sort_sd[] = $value['sd'];
      }
      $product = [];
      $ProductData = [];
      array_multisort($sort_sd, SORT_ASC, $sort_pd, SORT_STRING, $this->products);
      array_multisort($sort_pd, SORT_ASC, $sort_sd, SORT_STRING, $this->products);
      $productCategory = 1;
      for($product_number = 0; $product_number < count($this->products); $product_number++){
        if($product_number === 0){
          $product[pd] = $this->products[$product_number]['pd'];
          $product[tsp] = $this->products[$product_number]['sp'];
          $product[sd] = $this->products[$product_number]['sd'];
          $product[ct] = $this->products[$product_number]['ct'].'-p'.$productCategory;
          array_push($ProductData, $product);
        }
        else{
          if($this->products[$product_number]['ct']===$this->products[$product_number-1]['ct']){
            if($this->products[$product_number]['pd']===$this->products[$product_number-1]['pd']){
              $this->products[$product_number]['sp'] = $this->products[$product_number]['sp']+$this->products[$product_number-1]['sp'];
              $product[pd] = $this->products[$product_number]['pd'];
              $product[tsp] = $this->products[$product_number]['sp'];
              $product[sd] = $this->products[$product_number]['sd'];
              $product[ct] = $this->products[$product_number]['ct'].'-p'.$productCategory;
              array_push($ProductData, $product);
            }
            else{
              $productCategory += 1;
              $product[pd] = $this->products[$product_number]['pd'];
              $product[tsp] = $this->products[$product_number]['sp'];
              $product[sd] = $this->products[$product_number]['sd'];
              $product[ct] = $this->products[$product_number]['ct'].'-p'.$productCategory;
              array_push($ProductData, $product);
            }
          }
          else{
            $productCategory = 1;
            $product[pd] = $this->products[$product_number]['pd'];
            $product[tsp] = $this->products[$product_number]['sp'];
            $product[sd] = $this->products[$product_number]['sd'];
            $product[ct] = $this->products[$product_number]['ct'].'-p'.$productCategory;
            array_push($ProductData, $product);
          }
        }
      }
      return $ProductData;
    }
  }
?>
