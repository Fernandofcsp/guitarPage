<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos del Cliente</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
</head>
<body>
<?php include("Menu.php"); ?>   
<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();
$ids = $_REQUEST['id'];
$sql = "SELECT * FROM pedidos WHERE usuario = $ids AND status = 1";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
echo"<div  align=\"left\" style=\"margin-left:4%;\"><button type=\"button\" class=\"btn btn-dark\" id =\"regresar\" value=\"Regresar\" onclick = \"javascript: history.go(-1)\">Regresar</button></div>";
echo"<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Listado de Pedidos de Cliente Cerrados</h1>";
echo"<table  class=\"table table-dark w-auto\" border=\"1\" width=\"800\" height=\"200\" align=\"center\" valign=\"middle\" bordercolor=\"white\" style=\"color:white;\">";
echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
  echo"<td style=\"background-color:#dark;\">ID PEDIDO</td>";
  echo"<td style=\"background-color:#dark;\">FECHA</td>";
  echo"<td style=\"background-color:#dark;\">ID USUARIO</td>";
  echo"<td style=\"background-color:#dark;\">NOMBRE DEL CLIENTE</td>";
  echo"<td style=\"background-color:#dark;\">ACCIÓN</td>";
  echo"</tr>";
  for ($i = 0; $i < $num; $i++){
    $idPedido          = mysql_result($res, $i, "id");
    $fecha      = mysql_result($res, $i, "fecha");
    $idusuario   = mysql_result($res, $i, "usuario");

    $sql 	= "SELECT nombre FROM clientes
    WHERE id = $idusuario";
    $resnUser	    = mysql_query($sql, $con);
    $nUser   = mysql_result($resnUser, "nombre");
    echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
        echo"<td style=\"background-color:#85929E;\">$idPedido</td>";
        echo"<td style=\"background-color:#85929E;\">$fecha</td>";
        echo"<td style=\"background-color:#85929E;\">$idusuario</td>";
        echo"<td style=\"background-color:#85929E;\">$nUser</td>";
        echo"<td style=\"background-color:#85929E;\"><button id=\"botondet\" type=\"button\" class=\"btn btn-dark\" onclick = \"location.href='detalle_pedido.php?id_pedido=$idPedido'\">Ver Detalle</button></td>";
    echo"</tr>";
  }
?>
</body>
</html>