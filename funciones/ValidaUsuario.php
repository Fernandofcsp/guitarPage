<?php
session_start();
require "conecta.php";

$con = conecta();

// Obtener valores de usuario y contraseña de la solicitud POST
$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';
$pass = md5($pass);

// Consulta preparada para evitar inyecciones SQL
$sql = "SELECT id, nombre, apellidos, correo
        FROM clientes
        WHERE correo = ? AND pass = ? AND status = 1 AND eliminado = 0";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

$num = mysqli_stmt_num_rows($stmt);

if ($num) {
    mysqli_stmt_bind_result($stmt, $idU, $nombre, $apellidos, $correo);
    mysqli_stmt_fetch($stmt);

    $_SESSION['usuario'] = $idU;
    $_SESSION['nombre2'] = $nombre . ' ' . $apellidos;
    $_SESSION['correo'] = $correo;

    $resultband = 0;
    echo $resultband;
} else {
    $resultband = 1;
    echo $resultband;
}

// Cerrar la declaración y la conexión
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
