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
    $ar1 = [
      [
        "1","2","3"
      ],
      [
        "4","5","6"
      ]
    ];
    $ar2 = [
      [
        "7","8","9"
      ],
      [
        "10","55","12"
      ],
    ];
    $result = $array->ComputeMultiDimArray($ar1,$ar2);
    print_r($result);
  ?>
</body>
</html>
