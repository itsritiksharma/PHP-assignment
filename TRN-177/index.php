<!DOCTYPE html>
<html>
<head>
  <title>Calculator</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <form method='post'>
    <input type='number' id='first' name='first' >
    <input type='number' id='second' name='second'>
    <input type='submit' id='add' name='add' value='Add'>
    <input type='submit' id='subtract' name='subtract' value='Subtract'>
    <input type='submit' id='multiply' name='multiply' value='Multiply'>
    <input type='submit' id='divide' name='divide' value='Divide'>
  </form>
  <div id='displayresult'></div>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#add').on('click', function () {
        var n1 = parseInt($('#first').val());
        var n2 = parseInt($('#second').val());
        var r = n1 + n2;
        $('#displayresult').html("<h3>Sum= " + r + "</h3>");
        return false;
      });
      $('#subtract').on('click', function () {
        var n1 = parseInt($('#first').val());
        var n2 = parseInt($('#second').val());
        var r = n1 - n2;
        $('#displayresult').html("<h3>Subtract= " + r + "</h3>");
        return false;
      });
      $('#multiply').on('click', function () {
        var n1 = parseInt($('#first').val());
        var n2 = parseInt($('#second').val());
        var r = n1 * n2;
        $('#displayresult').html("<h3>Multiply= " + r + "</h3>");
        return false;
      });
      $('#divide').on('click', function () {
        var n1 = parseInt($('#first').val());
        var n2 = parseInt($('#second').val());
        var r = n1 / n2;
        $('#displayresult').html("<h3>Division= " + r + "</h3>");
        return false;
      });
    });
  </script>
</body>
</html>
