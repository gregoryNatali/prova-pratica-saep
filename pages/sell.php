<?php include('../utils/nav.php') ?>
<?php
require_once('../utils/dbconnect.php');
$model_get = $_GET['model'];

try {
  $sql_model = "SELECT aloc.automovel, autom.modelo, autom.preco, conc.concessionaria, conc.id 
              FROM alocacao aloc
              INNER JOIN automoveis autom ON aloc.automovel = autom.id
              INNER JOIN concessionarias conc ON aloc.concessionaria = conc.id
              WHERE aloc.automovel = $model_get
              ";

  $query_model = mysqli_query($conn, $sql_model);
} catch (mysqli_sql_exception $e) {
  var_dump($e);
  exit;
}
$model = array();

while ($each_model = mysqli_fetch_assoc($query_model)) {
  array_push($model, $each_model);
}

$sql_client = "SELECT id, nome FROM clientes";
$query_client = mysqli_query($conn, $sql_client);
$client = array();

while ($each_client = mysqli_fetch_assoc($query_client)) {
  array_push($client, $each_client);
}
?>

<link rel="stylesheet" href="../styles/sell.css">
<div id="sell-page-container">
  <?php
  foreach ($model as $model_item) {
  ?>

  <head>
    <title>
      <?= $model_item['modelo'] ?>
    </title>
  </head>
  <h1>
    <?= $model_item['modelo'] ?>
  </h1>
  <form id="selects-container" action="../utils/handleSellAction.php" method="post">
    <input type="hidden" name="idAutomovel" value="<?= $model_item['automovel'] ?>">
    <div>
      <label for="clientes">Clientes:</label>
      <select name="clientes">
        <?php
    foreach ($client as $client_item) {
        ?>
        <option value="<?= $client_item['id'] ?>">
          <?= $client_item['nome'] ?>
        </option>
        <?php } ?>
      </select>
    </div>
    <div>
      <label for="concessionarias">Concessionária:</label>
      <select name="idConcessionaria">
        <option value="<?= $model_item['id'] ?>">
          <?= $model_item['concessionaria'] ?>
        </option>
      </select>
    </div>
    <button type="submit" class="sell-button">Vender</a>
  </form>
  <?php } ?>

</div>