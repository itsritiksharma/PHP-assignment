<!DOCTYPE html>
<html>
<head>
  <title>Rock, Paper and Scissors game</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method='post'>
    Rock, paper or scissors? <input type='text' name='user_input'>
    <input type='submit' name='submit'value='Submit'>
  </form>
</body>
</html>
<?php
    include ('Game.php');
    use RPSGame\Game as Game;
    if (isset($_POST['submit'])){
      $new_game = new Game();
      $get_game = $new_game->RPS();
    }
?>
