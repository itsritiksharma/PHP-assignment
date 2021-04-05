<!DOCTYPE html>
<html>
<head>
  <title>Github Gists</title>
</head>
<body>
  <form action="" method="post">
    Code:
    <textarea name="code" cols="25" rows="10"> </textarea>
    <input type="submit" name="submit" value="Submit">
  </form>
  <?php
    $code = $_POST['code'];
    include 'Github.php';
    use GithubGists\Github as Github;
    if(isset($_POST['submit'])){
      $Github = new Github();
      $gist = $Github->SendDataToGist($code);
    }
  ?>
</body>
</html>
