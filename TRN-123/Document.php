<?php
  namespace DocumentLibrary;
  class Document{
    public $documentName, $documentType, $documentCollege, $sent;
    function __construct($docname, $doctype, $doccollege, $sent){
      $this->documentName = $docname;
      $this->documentType = $doctype;
      $this->documentCollege = $doccollege;
      if($sent==1){
        $sent='Success';
        $this->sent = $sent;
      }
      else{
        $sent='Fail';
        $this->sent = $sent;
      }

    }
  }
