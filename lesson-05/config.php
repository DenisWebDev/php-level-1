<?php
  define('_DB_HOST_', 'localhost');
  define('_DB_USER_', 'root');
  define('_DB_PASS_', '');
  define('_DB_NAME_', 'gallery');

  $db = mysqli_connect(_DB_HOST_, _DB_USER_, _DB_PASS_, _DB_NAME_) or die('DB connect error');
?>