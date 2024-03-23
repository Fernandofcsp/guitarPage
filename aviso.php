<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de acceso</title>
    <!-- Enlaces a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        /* Estilos personalizados */
        body {
            padding-top: 0px; /* Ajusta el espacio para la barra de navegación fija */
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">
    <br><br>
    <img class="mt-2" src="../images/aviso.png" width="300px" height="300px">
    <br><br><br>
    <p class="text-danger">¡Debes estar logueado para poder entrar a esta sección!</p>
    <br><br><br><br>
    <img class="mb-4" src="../images/logo2.png" width="370px" height="230px">
</div>
<?php include("piedePagina.php"); ?>

<!-- Scripts de Bootstrap (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<!-- Scripts de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
