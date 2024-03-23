<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['id'];
$sql = "SELECT *
		FROM productos
		WHERE id = $ids";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
include("Menu.php");
echo"<br><br>";
for ($i = 0; $i < $num; $i++){
    $archivo     = mysql_result($res, $i, "archivo");
    $id          = mysql_result($res, $i, "id");
    $nombre      = mysql_result($res, $i, "nombre");
    $codigo      = mysql_result($res, $i, "codigo");
    $descripcion = mysql_result($res, $i, "descripcion");
    $costo       = mysql_result($res, $i, "costo");
    $stock       = mysql_result($res, $i, "stock");
    $status      = mysql_result($res, $i, "status");
    $eliminado   = mysql_result($res, $i, "eliminado");
    $status_txt  = ($status == $eliminado) ? 'Inactivo' : 'Activo';

    echo"<div style=\"font-size: 30px;margin:0 135 40px\" align=\"left\" ><input type=\"button\" id =\"regresar\" value=\"Regresar al Listado\" onclick = \"location='productos_lista.php'\"></div>";
    echo"<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Foto de Producto</h1>";
    echo"<img src=\"../archivos/$archivo\" width=\"150\" height=\"150\"><br><br>";
	echo"<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Detalle de Producto</h1>";
    echo"<table  border=\"1\" width=\"800\" height=\"200\" align=\"center\" valign=\"middle\" bordercolor=\"white\" style=\"color:white;\">";
		echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;\">ID:</td>";
            echo"<td style=\"background-color:#E3E4E5;color:black;\">$id</td>";
            //echo"<td rowspan=\"3\" width=\"15\"></td>";
            echo"<td style=\"background-color:#85929E;\">COSTO:</td>";
            echo"<td style=\"background-color:#E3E4E5;color:black;\">$costo</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;\">NOMBRE:</td>";
            echo"<td style=\"background-color:#E3E4E5;color:black;\">$nombre</td>";
            
            echo"<td style=\"background-color:#85929E;\">STOCK:</td>";
            echo"<td style=\"background-color:#E3E4E5;color:black;\">$stock</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;\">CODIGO:</td>";
            echo"<td style=\"background-color:#E3E4E5;color:black;\">$codigo</td>";
            
            echo"<td style=\"background-color:#85929E;\">ESTADO:</td>";
            echo"<td style=\"background-color:#E3E4E5;color:black;\">$status_txt</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;\">DESCRIPCION:</td>";
            echo"<td colspan=\"3\" style=\"background-color:#E3E4E5;color:black;\">$descripcion</td>";
		echo"</tr>";
        /*
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td>COSTO:</td>";
            echo"<td>$costo</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td>STOCK:</td>";
            echo"<td>$stock</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td>ESTADO:</td>";
            echo"<td>$status_txt</td>";
		echo"</tr>";
        */
	echo"</table>";
	    
}
?>
<html>

<head>
 <title>Detalle de Producto</title>
 <script src="./js/jquery-3.3.1.min.js"></script>
 <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
</head>
<body>
</body>
</html>