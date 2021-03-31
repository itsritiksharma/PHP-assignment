<?php
  namespace Tablearea;
  class Table{
    function DispTable(){
      for($row=1; $row < 7; $row++){
        echo "<tr>";
        for($column=1; $column < 6; $column++){
          $multiply=$row*$column;
          echo '<td>'.$row.'*'.$column.'='.$multiply.'</td>';
        }
        echo "</tr>";
      }
    }
  }
?>
