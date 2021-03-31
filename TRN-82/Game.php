<?php
  namespace RPSGame;
  class Game{
    function RPS(){
      if (isset($_POST['submit'])){
        $user_input = strtolower($_POST['user_input']);
        $game_options = ['rock', 'paper', 'scissors'];
        $win_situations = ["rock"=>"scissors", "scissors"=>"paper", "paper"=>"rock"];
        $random_option = array_rand($game_options);
        $computer = $game_options[$random_option];
        if(empty($_POST['user_input'])){
          echo "Please input rock, paper or scissors";
        }
        else{
          echo "your input ".$user_input;
          echo '<br><br>';
          echo "comp input ".$computer;
          echo '<br><br>';
          if($user_input===$computer){
            echo "It's a Tie! Go again!";
          }
          else{
            $flag=0;
            foreach($win_situations as $key=>$value){
              if ($user_input===$key&&$computer===$value){
                $flag=1;
                break;
              }
              else{
                $flag= 0;
                continue;
              }
            }
            if($flag==0){
              echo "Try again!";
            }
            else{
              echo "Yay! you won!";
            }
          }
        }
      }
    }
  }
?>
