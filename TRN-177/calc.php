<?php
 $i1 = $_REQUEST['n1'];
 $i2 = $_REQUEST['n2'];
 $op = $_REQUEST['op'];
 switch($op)
  {
    case "--Select An Operator--":
      $output = "Choose valid operator";
      echo $output;
      break;

    case "+":
      $output = $i1 + $i2;
      echo $output;
      break;

    case "-":
      $output = $i1 - $i2;
      echo $output;
      break;

    case '*':
      $output = $i1 * $i2;
      echo $output;
      break;

    case '/':
      $output = $i1 / $i2;
      echo $output;
      break;

    default:
      echo $output = "Not Found...Please Enter only Integers or Decimals...";
  }
?>
