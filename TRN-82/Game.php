<?php
  namespace RPSGame;
  class Game{
    public $user_input;
    public $game_options;
    public $win_situations;
    public $random_option;
    public $computer;
    function __construct(){
      $this->user_input = strtolower($_POST['user_input']);
      $this->game_options = ['rock', 'paper', 'scissors'];
      $this->win_situations = ["rock"=>"scissors", "scissors"=>"paper", "paper"=>"rock"];
      $this->random_option = array_rand($this->game_options);
      $this->computer = $this->game_options[$this->random_option];
    }
    function RPS(){
      if (isset($_POST['submit'])){
        if(empty($_POST['user_input'])){
          echo "Please input rock, paper or scissors";
        }
        else{
          echo "your move ".$this->user_input;
          echo '<br><br>';
          echo "comp move ".$this->computer;
          echo '<br><br>';
          if($this->user_input===$this->computer){
            echo "It's a Tie! Go again!";
          }
          else{
            $match_result=0;
            foreach($this->win_situations as $key=>$value){
              if ($this->user_input===$key&&$this->computer===$value){
                $match_result=1;
                break;
              }
              else{
                $match_result= 0;
                continue;
              }
            }
            if($match_result==0){
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
