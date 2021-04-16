<!DOCTYPE html>
<html>
<head>
  <title>Ajax Calculator</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script>
    $(document).ready(function(){
      //general
      $('input[type=button]').click(function(){
        var num = $(this).val();
        var old = $('#display').html();
          //this will clear the screen
          if( num === 'C' ){
            $('#display').html('');
            return;
          }
          if( num === '=' ){
            $('#display').html(old);
            return;
          }
          $.ajax({
            url:'ajax.php',
            type: "POST",
            data:{'action':'operation','num':num,'old':old},
            success: function(msg){
              $('#display').html(msg);
            }
          }).error(function(){
            $('#display').html('Oops! An error occured');}
            );
        });
      //equal button click
      $('#eql').click(function(){
        var num = $('#display').html();
        var old = $('#display').html();
        $.ajax({
          url:'ajax.php',
          type: "POST",
          data:{'action':'equal', 'num':num, 'old':old},
          success: function(msg){
            $('#display').html(msg);
          }
        }).error(function(){
          $('#display').html('Oops! An error occured');}
          );
      });
    });
  </script>
</head>
<body>
  <table style="width:0;text-align:center;margin:0 auto"  class="table table-borderless">
    <tr>
      <td colspan="5"><textarea id="display" class="display"></textarea></td>
    </tr>
    <tr>
      <td><input value="7" type="button" class="btn btn-light"></td>
      <td><input value="8" type="button" class="btn btn-light"></td>
      <td><input value="9" type="button" class="btn btn-light"></td>
      <td><input id="div" value="/" type="button" class="but"></td>
    </tr>
    <tr>
      <td><input value="4" type="button" class="btn btn-light"></td>
      <td><input value="5" type="button" class="btn btn-light"></td>
      <td><input value="6" type="button" class="btn btn-light"></td>
      <td><input id="sub" value="-" type="button" class="but"></td>
    </tr>
    <tr>
      <td><input value="1" type="button" class="btn btn-light"></td>
      <td><input value="2" type="button" class="btn btn-light"></td>
      <td><input value="3" type="button" class="btn btn-light"></td>
      <td><input id="mul" value="*" type="button" class="but"></td>
    </tr>
    <tr>
      <td><input value="0" type="button" class="btn btn-light"></td>
      <td><input id="dot" value="." type="button" class="btn btn-light"></td>
      <td><input id="plus" value="+" type="button" class="but"></td>
    </tr>
    <tr>
      <td><input id="cls" value="C" type="button" class="btn btn-danger btn-lg"></td>
      <td><input id="eql" value="=" type="button" class="btn btn-success btn-lg"></td>
    </tr>
  </table>
</body>
</html>
