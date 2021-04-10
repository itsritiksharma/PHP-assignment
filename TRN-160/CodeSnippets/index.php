<!DOCTYPE html>
<html>
<head>
  <title>Code Snippets</title>
  <!-- Scripts to use tinyMCE rich textarea -->
  <script src="https://cdn.tiny.cloud/1/2lp5zvdv4ftt8gtnyrrzgfqmduk1z6zcfxvy2qhwn29pxzkf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
</head>
<body>
  <form method="post">
    Your Code snippet:<br><textarea name='snippet'></textarea><br>
    Description:<br><textarea name="description"></textarea><br>
    Language: <input type="text" name="language"><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>
  <?php

    include 'Snippet.php';

    use CodeSnippets\Snippet as Snippet;

    // Set variables to access database
    $servername = "localhost";
    $username = "root";
    $password = "Password";
    $dbname = "database";
    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //If there's an error die
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else {
      // Create new object of class Snippet
      $snippet = new Snippet($conn);
      //send data in database and retrieve it and store into $grid variable
      if(isset($_POST['submit'])){
        $snippet->sendDataToDatabase($_POST);
        $snippets = $snippet->retrieveData();
      }
    }
    //close connection
    $conn->close();
  ?>
  <!-- Show data, using foreach shorthand and different php tags so that it can be use with html tags -->
  <?php foreach($snippets as $code): ?>
    <?php echo $code['code_snippet'];?>
    <?php echo $code['code_description'];?>
    <?php echo $code['language'];?>
  <?php endforeach;?>
</body>
</html>
