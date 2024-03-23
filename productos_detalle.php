<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle</title>
  <script src="./js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
  <script>
    function recibe(idProducto) {
      var nombreFila = "#cantidad" + idProducto;
      var cantidad = $(nombreFila).val();
    
      $.ajax({
        url: 'agregaCarrito.php',
        type: 'post',
        data: { "idProducto": idProducto, "cantidad": cantidad },
        success: function(resultband) {
          if (resultband == 1) {  //bandera
            var mensajeFila = "#fila" + idProducto;
            $(mensajeFila).html('Agregado exitosamente').show();
            setTimeout(function() { $(mensajeFila).html('').show(); }, 2000);
          } else {
            $(mensajeFila).html('').show();
            setTimeout(function() { $(mensajeFila).html('').show(); }, 2000);
          }
        }, 
        error: function() {
          alert('Error archivo no encontrado...');
        }
      });	
    }
  </script>
</head>
<body>
<?php include("menu.php"); ?>
<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['codigo'];
$sql = "SELECT *
		FROM productos
		WHERE codigo = $ids";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);

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

    echo "<div align=\"left\" style=\"margin-left:2%;\"><button type=\"button\" class=\"btn btn-dark\" id=\"regresar\" value=\"Regresar\" onclick=\"javascript: history.go(-1)\">Regresar</button></div><br>";
    echo "<img src=\"../archivos/$archivo\" width=\"auto\" height=\"350\"><br><br>";
    echo "<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Detalle de Producto</h1>";
    echo "<table class=\"table table-dark w-70%\" border=\"1\" width=\"800\" height=\"200\" align=\"center\" valign=\"middle\" bordercolor=\"white\" style=\"color:white; width:70%;\">";
    echo "<tr height=\"50\" align=\"left\" valign=\"middle\">";
    echo "<td style=\"background-color:#85929E;\">NOMBRE:</td>";
    echo "<td colspan=\"3\" style=\"background-color:#E3E4E5;color:black;\">$nombre</td>";
    echo "</tr>";
    echo "<tr height=\"50\" align=\"left\" valign=\"middle\">";
    echo "<td style=\"background-color:#85929E;\">CODIGO:</td>";
    echo "<td colspan=\"3\" style=\"background-color:#E3E4E5;color:black;\">$codigo</td>";
    echo "</tr>";
    echo "<tr height=\"50\" align=\"left\" valign=\"middle\">";
    echo "<td style=\"background-color:#85929E;\">PRECIO:</td>";
    echo "<td colspan=\"3\" style=\"background-color:#E3E4E5;color:black;\">$$costo</td>";
    echo "</tr>";
    echo "<tr height=\"50\" align=\"left\" valign=\"middle\">";
    echo "<td style=\"background-color:#85929E;\">DESCRIPCION:</td>";
    echo "<td colspan=\"3\" style=\"background-color:#E3E4E5;color:black;\">$descripcion</td>";
    echo "</tr>";
    echo "<tr>";
    $concatenacion = 'cantidad' . $id;
    echo "<td colspan=\"2\"><div class=\"text-center\" >Cantidad: <select name=\"$concatenacion\" id=\"$concatenacion\">";
    echo "<option value=\"1\" selected>1</option>";
    for ($z = 1; $z <= $stock; $z++) {
      echo "<option value=\"$z\">$z</option>";
    }
    echo "</select>";
    echo "</div></td>";
    echo "</tr>";
    echo "</table>";
    echo "<p><input class=\"btn btn-light\" type=\"button\" value=\"Agregar al Carrito\" onclick=\"recibe($id);\">";
    $fila = 'fila' . $id;
    echo "<div id=\"$fila\" style=\"color:#FFFFFF;font-size:16px;\"></div></td>";
}
?>
</body>
<?php include("piedePagina.php"); ?>
</html>
