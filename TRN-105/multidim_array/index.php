<!DOCTYPE html>
<html>
<head>
  <title>Multi-dimensional array</title>
</head>
<body>
  <?php
    include 'multidim.php';
    use Multidimensional\ArrayDim as ArrayDim;
    $array = new ArrayDim();
    $result = $array->ComputeMultiDimArray();
    print_r($result);
  ?>
</body>
</html>
