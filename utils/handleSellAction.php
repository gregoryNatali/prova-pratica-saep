<?php
include_once("dbconnect.php");
$id_automovel = $_POST['idAutomovel'];
$id_concessionaria = $_POST['idConcessionaria'];

$update_sql = "UPDATE alocacao SET quantidade=quantidade-1 WHERE automovel =" . $id_automovel . " AND 
concessionaria=" . $id_concessionaria;

$select_sql = "SELECT area from alocacao WHERE automovel = " . $id_automovel . " AND concessionaria = " . $id_concessionaria;
$select_query = mysqli_query($conn, $select_sql);
$id_area = mysqli_fetch_assoc($select_query);

$update_query = mysqli_query($conn, $update_sql);


if ($update_query) {
  require('../pages/sold.php');
}


?>