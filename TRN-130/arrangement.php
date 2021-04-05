<?php
  namespace Seats;
  class arrangement{
    public $students;
    function __construct($students){
      $this->students = $students;
    }
    function seatArrangement(){
      $Boys = [];
      $Girls = [];
      $OrderedSeats = [];
      foreach($this->students as $student){
        if($student[gender]==="M"){
          array_push($Boys, $student[name]);
        }
        else{
          array_push($Girls, $student[name]);
        }
      }
      for($i=0;$i<count($Boys);$i++){
        array_push($OrderedSeats, $Boys[$i]);
        if($i<count($Girls)){
          array_push($OrderedSeats, $Girls[$i]);
        }
      }
      return $OrderedSeats;
    }
  }
?>
