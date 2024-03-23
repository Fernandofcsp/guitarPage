<?php
require "./funciones/conecta.php";
$con = conecta();

// Obtener el ID del usuario a mostrar
$ids = $_REQUEST['id'];

// Consulta SQL para obtener los detalles del usuario con el ID especificado
$sql = "SELECT *
        FROM administradores
        WHERE id = $ids";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

// Incluir el menú de navegación
include("Menu.php");
echo "<br><br>";

// Iterar sobre los resultados obtenidos de la consulta
for ($i = 0; $i < $num; $i++) {
    // Obtener los datos del usuario
    $row = mysqli_fetch_assoc($res);
    $archivo    = $row['archivo'];
    $id         = $row['id'];
    $nombre     = $row['nombre'];
    $apellidos  = $row['apellidos'];
    $correo     = $row['correo'];
    $rol        = $row['rol'];
    $status     = $row['status'];
    $eliminado  = $row['eliminado'];

    // Determinar el texto del rol y estado
    $rol_txt    = ($rol == 1) ? 'Empleado' : 'Administrador';
    $status_txt = ($status == $eliminado) ? 'Inactivo' : 'Activo';

    // Mostrar un botón para regresar al listado
    
    
    echo '<div class="text-left mb-3 ml-4">';
    echo '<a href="administradores_lista.php" class="btn btn-light">Regresar al listado</a>';
    echo '</div>';
    


    // Mostrar un card de Bootstrap para el detalle del usuario
    echo "<div class=\"container-fluid mt-5\">";
    echo "<div class=\"card bg-dark rounded \">";
    echo "<div class=\"card-body\">";
    
    // Mostrar la foto del usuario
    echo "<h5 class=\"card-title text-center text-white \">Foto de Usuario</h5>";
    echo "<img src=\"../archivos/$archivo\" class=\"mx-auto d-block img-fluid rounded \" style=\"max-width: 250px; max-height: 300px;\"><br>";
    
    // Mostrar el detalle del usuario en una tabla
    echo "<h5 class=\"card-title text-center text-white\">Detalle de Usuario</h5>";
    echo "<table class=\"table table-striped \">";
    echo "<thead class=\"table-dark\"> </thead>";
    echo "<tbody>";
    echo "<tr><th class=\"text-white\">ID:</th><td>$id</td></tr>";
    echo "<tr><th class=\"text-white\">NOMBRE:</th><td>$nombre $apellidos</td></tr>";
    echo "<tr><th class=\"text-white\">CORREO:</th><td>$correo</td></tr>";
    echo "<tr><th class=\"text-white\">ROL:</th><td>$rol_txt</td></tr>";
    echo "<tr><th class=\"text-white\">ESTADO:</th><td>$status_txt</td></tr>";
    echo "</tbody>";
    echo "</table>";

    echo "</div>";
    echo "</div>";
    echo "</div>";

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
    <!-- Bootstrap JS (jQuery is already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php include("piedePagina.php"); ?>
<body>
</body>
</html>
