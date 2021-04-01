<!DOCTYPE html>
<html>
<head>
  <title>Display student data</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <!-- create table -->
  <table cellspacing="0">
    <th>Name</th>
    <th>Dob</th>
    <th>Grade</th>
    <th>Subjects</th>
    <th>Result</th>
    <!-- create objects -->
    <?php
        include 'Student.php';
        include 'Subject.php';
        use StudentArea\Student as Student;
        use Subjects\Subject as Subject;
        // create an s1 object and store it in an array
        $s1=new Student('st1','Anthony',12,array('H' => 24, 'E' => 90,'M'=> 30),'15/08/1990');
        $student=[];
        array_push($student,$s1);
        //create subject objects
        $subject1=new Subject("Hindi","H",20);
        $subject2=new Subject("English","E",80);
        $subject3=new Subject("Maths","M",80);
        //store all the objects into an array
        $grade=[
          "12" => [$subject1,$subject2,$subject3],
        ];
    ?>
    <!-- Display data using foreach in html -->
    <?php foreach($student as $st): ?>
      <tr>
        <td><?= $st->name;?></td>
        <td><?= $st->dob;?></td>
        <td><?= $st->grade;?></td>
        <td>
        <!-- Print subject data in form #subject_code(#obtained_marks,#minimum_marks) -->
        <?php foreach($st->getSubjectsData($grade[$st->grade]) as $subjectData): ?>
          <?= $subjectData; ?><br>
        <?php endforeach;?>
        </td>
        <!-- Print whether the student is pass or fail -->
        <td><?= $st->getStudentResult($grade[$st->grade]);?></td>
      </tr>
    <?php endforeach;?>
  </table>
</body>
</html>
