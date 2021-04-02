<!DOCTYPE html>
<html>
<head>
  <title>College Document</title>
</head>
<body>
  <?php
    include 'College.php';
    include 'Document.php';
    use CollegeNames\College as College;
    use DocumentLibrary\Document as Document;
    $college1 = new College('College name 1', 'College ID 1');
    $college2 = new College('College name 2', 'College ID 2');
    $colleges=[];
    array_push($colleges, $college1,$college2);
    $document1 = new Document('Document 1', 'txt','College ID 1', 1);
    $document2 = new Document('Document 2', 'doc','College ID 2', 0);
    $document3 = new Document('Document 3', 'doc','', 0);
    $documents = [];
    array_push($documents, $document1, $document2, $document3);
    $colldocarray = [];
    $docarray = [];
    $collegewithdocumentsarray = [];
    foreach($colleges as $coll){
      foreach($documents as $doc){
        if(!empty($doc->documentCollege)){
          if($coll->collegeId===$doc->documentCollege){
            array_push($docarray,$doc);
          }
          else{
            continue;
          }
        }
        else{
          array_push($docarray,$doc);
        }
      }
      array_push($colldocarray,$coll,$docarray);
      array_push($collegewithdocumentsarray,$colldocarray);
      $docarray = [];
      $colldocarray = [];
    }
    print("<pre>".print_r($collegewithdocumentsarray,true)."</pre>");
    ?>
</body>
</html>
