<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Vista del perfil</title>
    <!-- Agregar Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        .rounded-img {
            border-radius: 10px; /* Bordes redondeados */
            border: 2px solid #ddd; /* Borde gris */
            padding: 5px; /* Espaciado interior */
        }
    </style>
</head>
<body>
<?php include("menu.php"); ?>
<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();

$ids = $_SESSION['usuario'];

// Obtener el progreso del usuario en temas
$sql = "SELECT *
        FROM progreso_tema
        WHERE id_usuario = ? AND eliminado != 1";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $ids);
$stmt->execute();
$result = $stmt->get_result();
$num2 = $result->num_rows;

// Obtener la cantidad total de temas disponibles
$sql = "SELECT *
        FROM temas
        WHERE status != 1 AND eliminado = 0";
$result = $con->query($sql);
$num3 = $result->num_rows;
$tema = ($num2 * 100) / $num3;

// Obtener los detalles del usuario
$sql = "SELECT *
        FROM clientes
        WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $ids);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

echo "<br>";
for ($i = 0; $i < $num; $i++) {
    $row = $result->fetch_assoc();
    $archivo = $row["archivo"];
    $nombre = $row["nombre"];
    $apellidos = $row["apellidos"];
    $correo = $row["correo"];
    $nivel = $row["nivel"];

    // Convertir el nivel numérico a texto
    $nivel_txt = '';
    switch ($nivel) {
        case 1:
            $nivel_txt = 'Básico';
            break;
        case 2:
            $nivel_txt = 'Intermedio';
            break;
        case 3:
            $nivel_txt = 'Avanzado';
            break;
    }

    echo "<div class='container'>";
    echo "<div class='row justify-content-center'>";
    echo "<div class='col-md-6'>";
    echo "<h1 class='text-center text-white font-weight-thin mb-4'>Foto de Usuario</h1>";
    echo "<img src='../archivos/$archivo' width='150' height='150' class='rounded-img mx-auto d-block mb-4'>";
    echo "<h1 class='text-center text-white font-weight-thin mb-4'>Detalle de Usuario</h1>";
    echo "<table class='table table-dark' style='width:100%;'>";
    echo "<tr>";
    echo "<th style='width:40%;'>NOMBRE:</th>";
    echo "<td>$nombre $apellidos</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>CORREO:</th>";
    echo "<td>$correo</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>NIVEL/CURSO:</th>";
    echo "<td>$nivel_txt</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>PROGRESO:</th>";
    echo "<td>" . round($tema, 2) . "% o $num2 de $num3 Temas</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>PEDIDOS CERRADOS:</th>";
    echo "<td><button type='button' class='btn btn-info' onclick='location=\"cliente_pedidos.php?id=$ids\"'>Ver Pedidos</button></td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>"; // col-md-6
    echo "</div>"; // row
    echo "</div>"; // container
}
echo "<div align='center' class='mt-4 mb-4'><button type='button' class='btn btn-primary' onclick='location=\"perfil_edita.php\"'>Editar Perfil</button></div>";
?>
<?php include("piedePagina.php"); ?>

</body>
</html>
