<?php
  $servername = "sql211.epizy.com";
  $username = "epiz_33981221";
  $password = "z6eb0tRvIc4oX";
  $dbname = "epiz_33981221_nattapon";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
