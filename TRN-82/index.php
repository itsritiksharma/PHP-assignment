<!DOCTYPE html>
<html>
<head>
  <title>Rock, Paper and Scissors game</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method='post'>
    <p>Please select your move:</p>
    <input type="radio" id="rock" name="user_input" value="rock">
    <label for="rock">Rock</label><br>
    <input type="radio" id="paper" name="user_input" value="paper">
    <label for="paper">Paper</label><br>
    <input type="radio" id="scissors" name="user_input" value="scissors">
    <label for="scissors">Scissors</label>
    <br><br>
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
