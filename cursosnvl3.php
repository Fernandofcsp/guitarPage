
<?php 
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])){
	echo "<script>location.href='aviso.php';</script>";
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CURSOS</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script>
   function recibe(nivel, lvl) {
      $.ajax({
        url: 'validanivel.php',
        type: 'post',
        data: {"nivel": nivel, "lvl": lvl },
        success: function(resultband) {
          if (lvl == 2 && resultband == 2) {
            window.location.replace("cursosnvl2.php");
          } 
          else if (lvl == 3 && resultband == 1) {
            window.location.replace("cursosnvl3.php");
          }
          else if (resultband == 0) {
            $('#mensaje').html('No puedes acceder a este curso porque no tienes el nivel necesario').show();
            setTimeout(function(){ $('#mensaje').html('').show();},2000);
          }
        }, 
        error: function() {
          alert('Error al procesar la solicitud');
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
$ids = $_SESSION['usuario'];

// Consulta preparada para obtener el nivel del usuario
$sql = "SELECT nivel FROM clientes WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $ids);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $nivel = $row['nivel'];
} else {
    echo "Error al obtener el nivel del usuario";
    exit;
}
?>
<!-- Barra de navegación -->
<nav class="navbar-expand-lg navbar-dark bg-dark mt-1 mb-1" style="margin-left: .5%;margin-right: .5%;">
  <div class="container-fluid">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-item nav-link" href="cursosnvl1.php">Nivel Básico<img src= "../images/nivel1.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
        <a class="nav-item nav-link" href="javascript:recibe(<?php echo $nivel; ?>, 2);">Nivel Intermedio<img src= "../images/nivel2.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
        <a class="nav-item nav-link" href="javascript:recibe(<?php echo $nivel; ?>, 3);">Nivel Avanzado<img src= "../images/nivel3.png" width="30px" height="30px"></a>
        </li>
      </ul>
  </div>
</nav>
<div id="mensaje" style="color:#FFFFFF; font-size:16px; display:none;"></div>
<?php
// Consulta SQL para obtener los temas del nivel básico
$sql = "SELECT * FROM temas WHERE status = 4 AND eliminado = 0";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

echo "<table class=\"table table-dark\" align=\"center\" style=\"width:99%\">";
echo "<tbody>";
echo "<tr>";
echo "<td colspan=\"6\">Cursos Nivel Avanzado</td>";
echo "</tr>";
echo "<tr>";
echo "<td class=\"align-middle\">Imagen del Curso</td>";
echo "<td class=\"align-middle\">Titulo</td>";

echo "<td class=\"align-middle\">Status</td>";
echo "<td class=\"align-middle\">Acción</td>";
echo "</tr>";
echo "<tr>";

while ($row = mysqli_fetch_assoc($res)) {
    $titulo = $row['titulo'];
    $descripcion = $row['descripcion'];
    $idTema = $row['id'];
    $id_administrador = $row['id_administrador'];
    $archivo = $row['archivo'];

    // Obtener el autor del tema
    $sql = "SELECT * FROM administradores WHERE id = $id_administrador";
    $resAdmin = mysqli_query($con, $sql);
    $rowAdmin = mysqli_fetch_assoc($resAdmin);
    $autor = $rowAdmin['nombre'] . " " . $rowAdmin['apellidos'];

    // Verificar el progreso del usuario en el tema
    $sql = "SELECT id_tema FROM progreso_tema WHERE id_usuario = $ids AND id_tema = $idTema";
    $resProgreso = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($resProgreso);
    $status = ($user['id_tema'] == $idTema) ? 'Completado ✓' : 'No completado X';

    // Mostrar los detalles del tema en la tabla
    echo "<td align=\"center\"><img class=\"img-fluid\"src=\"../archivos/$archivo\" width=\"130px\" height=\"150px\" onclick=\"location='temas_do.php?id=$idTema'\"></td>";
    echo "<td class=\"align-middle\">$titulo</td>";
    echo "<td class=\"align-middle\">$status</td>";
    echo "<td class=\"align-middle\"><input class=\"btn btn-light\" type=\"button\" value=\"Entrar\" onclick=\"location='temas_do.php?id=$idTema'\"></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
<?php include("piedePagina.php"); ?>

<!-- Scripts de Bootstrap (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<!-- Scripts de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
