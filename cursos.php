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
  <title>Vista de Cursos</title>

  <!-- Enlace a jQuery -->
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

 <!-- Estilos de Bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("menu.php"); ?>
<?php 
require "./funciones/conecta.php";
$con = conecta();

$ids = $_SESSION['usuario'];
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded mt-1">
  <div class="container">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="cursosnvl1.php">Nivel Básico<img src="../images/nivel1.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:recibe(<?php echo $nivel; ?>, 2);">Nivel Intermedio<img src="../images/nivel2.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:recibe(<?php echo $nivel; ?>, 3);">Nivel Avanzado<img src="../images/nivel3.png" width="30px" height="30px"></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Mensaje de error -->
<div class="container mt-3">
  <div id="mensaje" class="text-danger" style="font-size: 16px;"></div>
</div>

<!-- Imagen de cursos -->
<div class="container text-center mt-5">
  <img src="../images/guitarcourse.png" width="300px" height="300px">
</div>

<?php include("piedePagina.php"); ?>

<!-- Scripts de Bootstrap (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<!-- Scripts de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
