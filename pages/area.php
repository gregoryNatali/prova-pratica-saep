<?php include('../utils/nav.php') ?>
<?php
require_once('../utils/dbconnect.php');
$area_get = $_GET["area"];

$sql_area = "SELECT aloc.area, conc.concessionaria, autom.modelo, autom.id, autom.preco 
                  FROM alocacao aloc
                  INNER JOIN automoveis autom ON aloc.automovel = autom.id
                  INNER JOIN concessionarias conc ON aloc.concessionaria = conc.id
                  WHERE area = $area_get";

$query_area = mysqli_query($conn, $sql_area);
$area = array();

while ($each_area = mysqli_fetch_assoc($query_area)) {
  array_push($area, $each_area);
}

if (mysqli_num_rows($query_area) == 0) { //se não tiver automóveis
  require('unavaible_area.php');
}
?>
<div id="grid">
  <?php
  foreach ($area as $item) {
  ?>
  <div class="imovel-container">
    <h3>
      <?= $item['modelo'] ?>
    </h3>
    <p>
      <?= $item['concessionaria'] ?>
    </p>
    <h3>
      <?= $item['preco'] ?>
    </h3>
    <a classname="sell-button-a" href="sell.php?model=<?= $item['id'] ?>">Vender</a>
  </div>
  <?php } ?>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../global.css">
  <link rel="stylesheet" href="../styles/area.css">
  <?php
  echo "<title>Área $area_get</title>"
    ?>
</head>

<body>

</body>

</html>