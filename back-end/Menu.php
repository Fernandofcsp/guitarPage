<?php
session_start();
$idU = $_SESSION['idU'];
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];

if (!$_SESSION['idU']) {
    echo "<script>location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="mr-auto mt-4 mb-4">
            <a class="navbar-brand" href="#"><?php echo $nombre; ?></a>
            <button class="navbar-toggler ml-auto mt-4 mb-4" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="bienvenido.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="administradores_lista.php">Administradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clientes_lista.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="temas_lista.php">Temas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cursos.php">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productos_lista.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Pedidos.php">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="banners_lista.php">Banners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="salir.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Bootstrap JS (jQuery is already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-zv0px4yVKcqaWO9+w5a0Ov0YivNDO7+7uyzMDCx+4Og2m1vH9ckO5xaXQp0K+kCv" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2fss+" crossorigin="anonymous"></script>
</body>
</html>
