<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();

// Recibe variables
$nombre    = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo    = $_POST['correo'];
$pasw      = $_POST['pasw'];
$passEnc   = md5($pasw);

// Verifica existencia y ayuda a validar que no se envíen datos al formulario si el correo ya existe
$sql = "SELECT * FROM clientes WHERE correo = '$correo'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if ($num < 1) {
    // Inserta en BD
    $sql = "INSERT INTO clientes (nombre, apellidos, correo, pass) VALUES ('$nombre', '$apellidos', '$correo', '$passEnc')";
    $res = mysqli_query($con, $sql);

    // Logueo automático después de registro
    $user = $correo;
    $pass = $pasw;
    $pass = md5($pass);

    $sql = "SELECT * FROM clientes WHERE correo = '$user' AND pass = '$pass' AND status = 1 AND eliminado = 0";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);

    if ($num) {
        $row = mysqli_fetch_assoc($res);
        $idU     = $row['id'];
        $nombre  = $row['nombre'] . ' ' . $row['apellidos'];
        $correo  = $row['correo'];

        $_SESSION['usuario']    = $idU;
        $_SESSION['nombre2']    = $nombre;
        $_SESSION['correo']     = $correo;

        header("Location: index.php");
        exit(); // Salir del script después de la redirección
    }
}
?>
