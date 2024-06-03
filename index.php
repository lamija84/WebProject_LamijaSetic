<?php
  
  $env = getenv('DB_NAME');

  if ($env != null) {
      header("Location: /index.html");
  } else {
      header("Location: /WebProject_LamijaSetic_new/index.html");
  }

  die();
?>