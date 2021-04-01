<?php
  namespace StudentArea;
  class Student{
    public $id, $name, $grade, $marks, $dob;
    function __construct($id, $name, $grade, $marks, $dob){
      $this->id = $id;
      $this->name = $name;
      $this->grade = $grade;
      $this->marks = $marks;
      $this->dob = $dob;
    }
    // function displayStudentData(){
    //   echo $this->id;
    //   echo $this->name;
    //   echo $this->grade;
    //   echo $this->marks;
    //   echo $this->dob;
    // }
    // function getStudentSubjectDetails(){
    //   return $this->marks;
    // }
    //Function to get the final result
    function getStudentResult($subjectMapping){
      $subjectsPassedCount=0;
      for($i=0;$i<count($subjectMapping);$i++){
        if ($subjectMapping[$i]->subjectMinimumMarks <= $this->marks[$subjectMapping[$i]->subjectCode]){
          $subjectsPassedCount+=1;
        }
      }
      $passingSubjects=count($subjectMapping)*0.4;
      if($passingSubjects<=$subjectsPassedCount){
        return "Pass";
      }
      else{
        return "Fail";
      }
    }
    //function to get the subjects in form H(#obtained_marks,#minimum_marks)
    function getSubjectsData($subjectMapping){
      $outputArray=[];
      for($i=0;$i<count($subjectMapping);$i++){
        $string_data=$subjectMapping[$i]->subjectCode."(".$this->marks[$subjectMapping[$i]->subjectCode].", ".$subjectMapping[$i]->subjectMinimumMarks.")";
        array_push($outputArray,$string_data);
      }
      return $outputArray;
    }
  }
  // class Subject{
  //   public $subjectName,$subjectCode,$subjectMinimumMarks;
  //   function __construct($sname,$scode,$smm){
  //     $this->subjectName=$sname;
  //     $this->subjectCode=$scode;
  //     $this->subjectMinimumMarks=$smm;
  //   }
  //   // function displaySubject(){
  //   //     echo $this->subjectName;
  //   //     echo $this->subjectCode;
  //   //     echo $this->subjectMinimumMarks;
  //   // }
  // }
?>
