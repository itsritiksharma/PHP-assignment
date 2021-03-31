<!DOCTYPE html>
<html>
<head>
  <title>Chessboard</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <table cellspacing="0">
    <?php
    include 'Chess.php';
    use Chessboard\Chess as Board;
    $board = new Board();
    $chess_board = $board->DispChessBoard();
    ?>
  </table>
</body>
</html>
