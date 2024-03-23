<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del pedido</title>
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
<br> 

<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();
$idPedido = $_REQUEST['id_pedido'];

$sql 	= "SELECT * FROM pedidos_productos
  WHERE id_pedido = $idPedido";
  $res	= mysql_query($sql, $con);
  $num	= mysql_num_rows($res);
  echo"<div  align=\"left\" style=\"margin-left:4%;\"><button type=\"button\" class=\"btn btn-dark\" id =\"regresar\" value=\"Regresar\" onclick = \"javascript: history.go(-1)\">Regresar</button></div>";
  echo"<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Detalles del pedido</h1>";
  echo"<table  class=\"table table-dark w-auto\" border=\"1\" width=\"800\" height=\"200\" align=\"center\" valign=\"middle\" bordercolor=\"white\" style=\"color:white;\">";
  echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
	echo"<td style=\"background-color:#85929E;\">Producto</td>";
  echo"<td style=\"background-color:#85929E;\">Cantidad</td>";
  echo"<td style=\"background-color:#85929E;\">Costo Unitario</td>";
  echo"<td style=\"background-color:#85929E;\">Subtotal</td>";
  echo"</tr>";
  for ($i = 0; $i < $num; $i++){
    $idProducto          = mysql_result($res, $i, "id_producto");
    $cantidad      = mysql_result($res, $i, "cantidad");
    $precio   = mysql_result($res, $i, "precio");

    $sql 	= "SELECT nombre FROM productos
    WHERE id = $idProducto";
    $resnProduct	    = mysql_query($sql, $con);
    $nProducto   = mysql_result($resnProduct, "nombre");

  $subtotal = $cantidad*$precio;
  $total=$total+$subtotal;
  $concatenacion = 'filas' . $idProducto;
  echo"<tr id=$concatenacion height=\"50\" align=\"left\" valign=\"middle\">";
  echo"<td  style=\"background-color:#E3E4E5;color:black;\">$nProducto</td>";
  echo"<td  style=\"background-color:#E3E4E5;color:black;\">$cantidad</td>";
  echo"<td  style=\"background-color:#E3E4E5;color:black;\">$precio</td>";
  echo"<td  id=\"sub\" name=\"sub\" style=\"background-color:#E3E4E5;color:black;\">$subtotal</td>";
  echo"</tr>";
  }
  echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
  echo"<td style=\"background-color:#85929E;\">Total</td>";
 
  echo"<td id=\"tot\" colspan=\"4\" style=\"background-color:#E3E4E5;color:black;\">$total</td>";
  echo"</tr>";
  echo"</table>";
  

  



?>
</body>
</html>

