<?php

  /**
  *
  * @file
  *
  * echo the operating system PHP is running on, PHP browser detection script. PHP script, to check whether
  * the page is called from 'https' or 'http'.
  *
  */

  // Echo Operating system details
  echo "<h2>Operating System</h2>";
  echo php_uname();
  echo '<br>';
  // Echo Browser details
  echo "<h2>Browser</h2>";
  echo $_SERVER['HTTP_USER_AGENT'];
  $browser = get_browser(null, true);
  print_r($browser);
  echo '<br>';
  // Check whether the page is called from 'https' or 'http'.
  echo "<h2>HTTP or HTTPS?</h2>";
  if (!empty($_SERVER['HTTPS'])){
    echo 'https is enabled';
  }
  else{
    echo 'http is enabled';
  }
?>
