<!DOCTYPE html>
<html>
<head>
  <title>Product Data</title>
</head>
<body>
  <?php
    include 'Products.php';
    use AllProducts\Products as Products;
    $Products = array(
    array('pd' => 'pd1', 'sp' => 5, 'sd' => '4thFeb', 'ct' => 'C1'),
    array('pd' => 'pd1', 'sp' => 15, 'sd' => '5thFeb', 'ct' => 'C1'),
    array('pd' => 'pd2', 'sp' => 50, 'sd' => '4thFeb', 'ct' => 'C1'),
    array('pd' => 'pd3', 'sp' => 40, 'sd' => '6thFeb', 'ct' => 'C2'),
    array('pd' => 'pd2', 'sp' => 75, 'sd' => '3rdFeb', 'ct' => 'C1'),
    array('pd' => 'pd2', 'sp' => 65, 'sd' => '7thFeb', 'ct' => 'C1'),
    array('pd' => 'pd4', 'sp' => 190, 'sd' => '8thFeb', 'ct' => 'C2'),
    );
    $Product = new Products($Products);
    $Data = $Product->ProductData();
    print('<pre>'.print_r($Data,true).'</pre>');
  ?>
</body>
</html>
