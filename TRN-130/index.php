<!DOCTYPE html>
<html>
<head>
  <title>Seat arrangement</title>
</head>
<body>
  <?php
    include 'arrangement.php';
    use Seats\arrangement as arrangement;
    $students = array(
      array(
        "name" => "Naman",
        "gender" => "M"
      ),
      array(
        "name"=>"Aman",
        "gender"=>"M"
      ),
      array(
        "name"=>"Aashna",
        "gender"=>"F"
      ),
      array(
        "name"=>"Chaman",
        "gender"=>"M"
      ),
      array(
        "name"=>"Pawan",
        "gender"=>"M"
      ),
      array(
        "name"=>"Anshika",
        "gender"=>"F"
      ),
      array(
        "name"=>"Bhawan",
        "gender"=>"M"
      ),
      array(
        "name"=>"Aashita",
        "gender"=>"F"
      ),
      array(
        "name"=>"Raman",
        "gender"=>"M"
      ),
      array(
        "name"=>"Anshuman",
        "gender"=>"M"
      ),
    );
    $arrange = new arrangement($students);
    $arrangedSeats = $arrange->seatarrangement();
    print('<pre>'.print_r($arrangedSeats,true).'</pre>');
  ?>
</body>
</html>
