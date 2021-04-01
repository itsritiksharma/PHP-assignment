<?php
  namespace Subjects;
  class Subject{
    public $subjectName,$subjectCode,$subjectMinimumMarks;
    //call constructor function whenever the class is called and set public variables equal to the data from objects
    function __construct($sname,$scode,$smm){
      $this->subjectName=$sname;
      $this->subjectCode=$scode;
      $this->subjectMinimumMarks=$smm;
    }
    // function displaySubject(){
    //     echo $this->subjectName;
    //     echo $this->subjectCode;
    //     echo $this->subjectMinimumMarks;
    // }
  }
?>
