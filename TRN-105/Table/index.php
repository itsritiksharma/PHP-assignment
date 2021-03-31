<!DOCTYPE html>
<html>
<head>
  <title>Table</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <table cellspacing="0">
    <?php
    include 'Table.php';
    use Tablearea\Table as Table;
    $table = new Table();
    $output_table = $table->DispTable();
    ?>
  </table>
</body>
</html>
