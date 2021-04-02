<!DOCTYPE html>
<html>
<head>
  <title>Tournament</title>
</head>
<body>
  <?php
    include 'Result.php';
    use FinalResult\Result as Result;
    use LockerRoom\Players as Player;
    use TeamLineup\Teams as Team;
    $matches = [
      "matchA" => [
        "team_1" =>[
          "BlaZe Star" => 45,
          "Scarface" => 20
        ],
        "team_2" => [
          "Aluminum" => 19,
          "player_name2" => 35
        ]
      ],
      "matchB" => [
        "team_2" =>[
          "player_name1" => 69,
          "player_name2" => 96
        ],
        "team_3" => [
          "player_name1" => 75,
          "player_name2" => 100
        ]
      ],
      "matchC" => [
        "team_3" =>[
          "player_name1" => 12,
          "player_name2" => 32
        ],
        "team_4" => [
          "player_name1" => 21,
          "player_name2" => 54
        ]
      ],
      "matchD" => [
        "team_1" =>[
          "player_name1" => 65,
          "player_name2" => 47
        ],
        "team_3" => [
          "player_name1" => 56,
          "player_name2" => 20
        ]
      ],
      "matchE" => [
        "team_1" =>[
          "player_name1" => 89,
          "player_name2" => 90
        ],
        "team_4" => [
          "player_name1" => 38,
          "player_name2" => 48
        ]
      ],
      "matchF" => [
        "team_2" =>[
          "Ronaldo" => 112,
          "player_name2" => 59
        ],
        "team_4" => [
          "player_name1" => 31,
          "player_name2" => 79
        ]
      ],
    ];
    $Tournament = new Result($matches);
    $Highestscore = $Tournament->HighestScore();
    echo "Highest scoring player is: ".$Highestscore;
    echo '<br>';
    $Winnerteam = $Tournament->WinnerTeam();
    echo "Winner team is: ".$Winnerteam;
    echo '<br>';
    echo "Max score is: ";
    $Maxscore = $Tournament->MaxScore();
    ?>
</body>
</html>
