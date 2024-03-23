<?php
session_start();
require "conecta.php";

$con = conecta();
$user = $_REQUEST['user'] ?? '';
$pass = $_REQUEST['pass'] ?? '';
$pass = md5($pass);

$sql = "SELECT * FROM administradores
        WHERE correo = '$user' AND pass = '$pass'
        AND status = 1 AND eliminado = 0";
$res = mysqli_query($con, $sql);

$num = mysqli_num_rows($res);

if ($num) {
    $row = mysqli_fetch_assoc($res); // Obtener la fila como un array asociativo
    $idU = $row['id']; // Obtener el valor de 'id' del array asociativo
    $nombre = $row['nombre'] . ' ' . $row['apellidos']; // Concatenar los valores de 'nombre' y 'apellidos'
    $correo = $row['correo']; // Obtener el valor de 'correo'

    $_SESSION['idU'] = $idU;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['correo'] = $correo;

    $resultband = 0;
    echo $resultband;
} else {
    $resultband = 1;
    echo $resultband;
}
?>
