<?php
  namespace CollegeNames;
  class College{
    public $collegeName, $collegeId;
    function __construct($collname, $collid){
      $this->collegeName = $collname;
      $this->collegeId = $collid;
    }
  }
