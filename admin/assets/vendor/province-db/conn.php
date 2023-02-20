<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thailand";

// Create connection
$connProvinces = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connProvinces->connect_error) {
  die("Connection failed: " . $connProvinces->connect_error);
  $connProvinces -> close();
}
mysqli_set_charset($connProvinces,"utf8");
?>