<?php

if(isset($_POST)){
  extract($_POST);
  // var_dump($_POST);
  $operators = array('+', '-', '*', '/', '.', '=');
  $out = '';
  switch($action){
    case 'equal':
    $last = '';
    if(strlen($old)>0) {
      $last = substr($old, -1);
    }
    if($old <> '' and !in_array($last, $operators)){
     $out = eval("return ($old);");
   } else {
    $out = $old;
  }
  break;
  case 'operation':
  $last = '';
  if(strlen($old)>0) {
    $last = substr($old, -1);
  }
  if( in_array($last, $operators) and in_array($num, $operators) ){

    $out = $old;

  } else if($old == '' and in_array($num, $operators ) and $num<>'.'){
    $out = '';
  } else {
    $out = $old.$num;
  }
  break;
  default: $out = $old;
}
echo $out;
}
