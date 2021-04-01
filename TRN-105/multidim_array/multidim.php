<?php
namespace Multidimensional;
class ArrayDim{
  function ComputeMultiDimArray($array1,$array2) {
    if(count($array1)!=count($array2)){
      echo "Please send equal array";
    }
    else{
      for($index=0;$index<count($array1);$index++){
        for ($index2=0;$index2<count($array1[$index]);$index2++){
          $diff[$index][$index2] = $array2[$index][$index2]-$array1[$index][$index2];
        }
      }
    }
    return $diff;
  }
}
?>
