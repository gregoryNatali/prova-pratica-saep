<?php

$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "saep_gregory_natali";

// cria a conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);
// verifica a conexão
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?> 