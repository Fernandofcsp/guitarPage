<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCTOS</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
        /* Estilos personalizados */
        .rounded-img {
            border-radius: 10px; /* Bordes redondeados */
            border: 2px solid #ddd; /* Borde gris */
            padding: 5px; /* Espaciado interior */
        }
    </style>
  <script>
    function recibe(idProducto) {
      // Verificar si hay una sesión activa
      <?php session_start();?>
      var sesionActiva = "<?php echo isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) ? 'true' : 'false'; ?>";
      
      if (sesionActiva === 'true') {
        nombreFila = "#cantidad" + idProducto;
        var cantidad = $(nombreFila).val();

        $.ajax({
          url: 'agregaCarrito.php',
          type: 'post',
          data: { "idProducto": idProducto, "cantidad": cantidad },
          success: function(resultband) {
            if (resultband == 1) {  //bandera
              mensajeFila = "#fila" + idProducto;
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
      } else {
        alert('Por favor, inicia sesión para agregar productos al carrito.');
      }
    }
  </script>
</head>
<body>
<?php include("menu.php"); ?>
<?php
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT *
    FROM productos
    WHERE status = 1 AND eliminado = 0 AND stock != 0";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($res);

$nombre = array();
$codigo = array();
$costo = array();
$archivo = array();

echo "<div class=\"container mt-5\">";
echo "<div class=\"row justify-content-center\">";

for ($i = 0; $i < $num; $i++) {
  $row = mysqli_fetch_assoc($res);

  $nombre[$i] = $row["nombre"];
  $codigo[$i] = $row["codigo"];
  $idProducto[$i] = $row["id"];
  $costo[$i] = $row["costo"];
  $archivo[$i] = $row["archivo"];

  echo "<div class=\"col-lg-4 col-md-6 col-sm-12 mb-4\">";
  echo "<div class=\"card p-4 bg-dark text-white rounded border border-secondary\" style=\"width: 23rem; height: 30rem;\">"; // Establece un tamaño fijo para cada cuadrícula de producto
  echo "<div class=\"d-flex justify-content-center align-items-center\" style=\"height: 200px;\">"; // 
  echo "<img src=\"../archivos/{$archivo[$i]}\" class=\"card-img-top rounded-img mx-auto d-block mb-4\" alt=\"...\" style=\"height: 200px; width: 120px;\">"; // Establece un tamaño fijo para las imágenes
  echo "</div>";
  echo "<div class=\"card-body\">";
  echo "<h5 class=\"card-title\">{$nombre[$i]}</h5>";
 
  echo "<p class=\"card-text\">\${$costo[$i]}</p>";
  echo "<div class=\"text-center\">";
  echo "<select class=\"rounded\" name=\"cantidad{$idProducto[$i]}\" id=\"cantidad{$idProducto[$i]}\">";
  echo "<option value=\"1\" selected>1</option>";
  $sql = "SELECT stock FROM productos WHERE id = ?";
  $stmtStock = mysqli_prepare($con, $sql);
  mysqli_stmt_bind_param($stmtStock, "i", $idProducto[$i]);
  mysqli_stmt_execute($stmtStock);
  $resnStock = mysqli_stmt_get_result($stmtStock);
  $stockProducto = mysqli_fetch_assoc($resnStock)["stock"];
  for ($z = 1; $z <= $stockProducto; $z++) {
    echo "<option value=\"$z\">$z</option>";
  }
  echo "</select>";
  echo "</div>";
  echo "<button class=\"btn btn-light mb-2 mt-2\" onclick=\"recibe($idProducto[$i]);\">Agregar al Carrito</button>";
  echo "<div id=\"fila$idProducto[$i]\" style=\"color:#FFFFFF;font-size:16px;\"></div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
}

echo "</div>";
echo "</div>";
?>
<?php include("piedePagina.php"); ?>
</body>
</html>
