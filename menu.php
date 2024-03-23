<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null; 
$nombre = $_SESSION['nombre2'] ?? null; 
$usuarioAutenticado = isset($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link
      href="./js/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
    <script src="./js/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="./js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
    <style>
      @media (max-width: 768px) {
        .navbar-nav,
        .d-flex {
          justify-content: center;
        }
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark rounded" style="background-color: #343a40; margin-left: 0%; margin-right: 0%;">
  <div class="container-fluid">
    <a class="navbar-brand"><img src="../images/logo2.png" width="150px" height="80px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home <img src="../images/home.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cursos.php">Cursos <img src="../images/cursos.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productos.php">Productos <img src="../images/productos.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contacto_formulario.php">Contacto <img src="../images/contacto.png" width="30px" height="30px"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="carrito01.php">Carrito <img src="../images/carrito.png" width="30px" height="30px"></a>
        </li>
      </ul>
      <!-- Aquí se muestran las opciones de inicio de sesión o perfil y cerrar sesión -->
      <div class="d-flex">
        <?php if (!$usuarioAutenticado): ?>
          <a class="btn btn-success p-2" href="cliente_inicio.php">Inicia Sesión</a>
        <?php else: ?>
          <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $nombre; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="perfil.php">Perfil</a>
              <a class="dropdown-item" href="salir.php">Cerrar Sesión</a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
</body>
</html>
