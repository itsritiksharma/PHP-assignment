<?php

  /**
  *
  * @file
  *
  * Request incoming numbers and operator and echo the desired output once match found.
  *
  */

  // Request incoming parameters
  $no1 = $_REQUEST['n1'];
  $no2 = $_REQUEST['n2'];
  $op = $_REQUEST['op'];
  // Run switch case on operator to echo the output
  switch($op){
    case "--Select An Operator--":
      $output = "Choose valid operator";
      echo $output;
      break;
    // If user chooses Add then add the numbers and echo
    case 'Add':
      $output = $no1 + $no2;
      echo $output;
      break;
    // If user chooses Subtract then echo the difference of numbers.
    case 'Subtract':
      $output = $no1 - $no2;
      echo $output;
      break;
    // If user chooses Multiply then echo the product of the numbers.
    case 'Multiply':
      $output = $no1 * $no2;
      echo $output;
      break;
    // If user chooses Divide then echo the division of the numbers.
    case 'Divide':
      $output = $no1 / $no2;
      echo $output;
      break;
    // If none of these is true run default case
    default:
      echo $output = "Not Found...Please Enter only Integers or Decimals...";
  }
?>
