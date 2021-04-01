<?php
  namespace Tablearea;
  class Table{
    function DispTable($rows,$columns){
      for($row=1; $row < $rows+1; $row++){
        echo "<tr>";
        for($column=1; $column < $columns+1; $column++){
          $multiply=$row*$column;
          echo '<td>'.$row.'*'.$column.'='.$multiply.'</td>';
        }
        echo "</tr>";
      }
    }
  }
?>
