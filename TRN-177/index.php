<?php
  echo "<h2>Operating System</h2>";
  echo php_uname();
  echo '<br>';
  echo "<h2>Browser</h2>";
  echo $_SERVER['HTTP_USER_AGENT'];
  $browser = get_browser(null, true);
  print_r($browser);
  echo '<br>';
  echo "<h2>HTTP or HTTPS?</h2>";
  if (!empty($_SERVER['HTTPS'])){
    echo 'https is enabled';
  }
  else{
    echo 'http is enabled';
  }
?>
