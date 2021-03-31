<?php
  namespace Chessboard;
  class Chess{
    function DispChessBoard(){
      for($row=0; $row < 8; $row++){
        echo "<tr>";
        for($column=0; $column < 8; $column++){
          if($row % 2 == 0){
            if($column % 2 == 0){
              echo '<td class="white"></td>';
            } else {
              echo '<td class="black"></td>';
            }
          }
          else {
            if($column % 2 == 0){
              echo '<td class="black"></td>';
            } else {
              echo '<td class="white"></td>';
            }
          }
        }
        echo "</tr>";
      }
    }
  }
?>
