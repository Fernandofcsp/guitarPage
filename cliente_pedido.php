<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido del Cliente</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
</head>
<body>
<?php include("menu.php"); ?>   
<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();
$ids = $_REQUEST['id_pedido'];
$sql = "SELECT * FROM pedidos WHERE id = $ids AND status = 1";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

echo "<h1 class=\"none text-center mt-5\" style=\"font-weight: thin;\">Pedido del Cliente</h1>";
echo "<div class=\"table-responsive\">";
echo "<table class=\"table table-dark table-sm\" style=\"color:white;\">";
echo "<thead><tr>";
echo "<th>ID PEDIDO</th>";
echo "<th>FECHA</th>";
echo "<th>ID USUARIO</th>";
echo "<th>NOMBRE DEL CLIENTE</th>";
echo "<th>ACCIÓN</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($row = mysqli_fetch_assoc($res)) {
    $idPedido = $row['id'];
    $fecha = $row['fecha'];
    $idusuario = $row['usuario'];

    $sql  = "SELECT nombre FROM clientes WHERE id = $idusuario";
    $resnUser = mysqli_query($con, $sql);
    $rowUser = mysqli_fetch_assoc($resnUser);
    $nUser = $rowUser['nombre'];

    echo "<tr>";
    echo "<td>$idPedido</td>";
    echo "<td>$fecha</td>";
    echo "<td>$idusuario</td>";
    echo "<td>$nUser</td>";
    echo "<td><button id=\"botondet\" type=\"button\" class=\"btn btn-dark\" onclick=\"location.href='detalle_pedido.php?id_pedido=$idPedido'\">Ver Detalle</button></td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";
?>
<?php include("piedePagina.php"); ?>
</body>
</html>
