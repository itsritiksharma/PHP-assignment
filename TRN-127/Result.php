<?php
  namespace FinalResult;
  class Result{
    public $matches;
    function __construct($matches){
      $this->matches = $matches;
    }
    function HighestScore(){
      $s = 0;
      foreach($this->matches as $match=>$team){
        foreach($team as $playername=>$playerscore){
          foreach($playerscore as $name=>$score){
            if ($score > $s){
              $s = $score;
            }
            else{
              continue;
            }
          }
        }
      }
      foreach($this->matches as $match=>$team){
        foreach($team as $playername=>$playerscore){
          foreach($playerscore as $name=>$score){
            if ($score == $s){
              $n = $name;
            }
            else{
              continue;
            }
          }
        }
      }
      return $n;
    }
    function WinnerTeam(){
      $winnerlist = [];
      $matchwinnerscore = [];
      $wincount = [];
      $arr = [
        "team_1"=>0,
        "team_2"=>0,
        "team_3"=>0,
        "team_4"=>0
      ];
      foreach($this->matches as $match=>$team){
        $team_name = [];
        $teamscore = [];
        $matchwinner = [];
        $winnert = [];
        $winnerscore =[];
        $t = 0;
        $s = 0;
        $a = 0;
        $i = 0;
        foreach($team as $teamname=>$player){
          foreach($player as $playername=>$score){
            $s += $score;
          }
          $teamscore[$i++] = $s;
          $team_name[] = $teamname;
          $s = 0;
        }
        if($teamscore[0] > $teamscore[1]){
          array_push($matchwinner, $team_name[0]);
          array_push($winnerscore, $teamscore[0]);
        }
        else{
          array_push($matchwinner, $team_name[1]);
          array_push($winnerscore, $teamscore[1]);
        }
        array_push($winnerlist, $matchwinner);
        array_push($matchwinnerscore, $winnerscore);
      }
      foreach($winnerlist as $winner){
        $arr[$winner[0]]+=1;
      }

      $max = 0;
      foreach($arr as $result){
        if($result > $max){
          $max = $result;
        }
      }

      while ($finalwinner = current($arr)) {
        if ($finalwinner == $max) {
          $WinnerTeamName = key($arr);
        }
        next($arr);
      }
      return $WinnerTeamName;
    }
    function MaxScore(){
      foreach($this->matches as $match=>$team){
        $team_name = [];
        $teamscore = [];
        $winner = [];
        $winnert = [];
        $highestscore = [];
        $t = 0;
        $s = 0;
        $a = 0;
        $i = 0;
        foreach($team as $teamname=>$player){
          foreach($player as $playername=>$score){
            $s += $score;
          }
          $teamscore[$i++] = $s;
          $s = 0;
        }
        if($teamscore[0] > $teamscore[1]){
          array_push($winner, $teamscore[0]);
        }
        else{
          array_push($winner, $teamscore[1]);
        }
      foreach($winner as $score){
        print_r($score);
        echo ' ';
      }
      }
    }
  }
?>
